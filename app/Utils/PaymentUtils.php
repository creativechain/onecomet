<?php


namespace App\Utils;


use App\CurrencyPrice;
use App\Payment;
use App\PaymentMeta;
use App\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Stripe\Checkout\Session;

class PaymentUtils
{

    /**
     * @return array
     */
    public static function getAvailableMethods() {
        $methods = Settings::getAvailableMethods();
        return explode(',', $methods->meta_value);
    }

    /**
     * @return array
     */
    public static function getTranslatedAvailableMethods() {
        $methods = self::getAvailableMethods();

        $tMethods = [];
        foreach ($methods as $m) {
            $tMethods[$m] = trans("payments.type.$m");
        }

        return $tMethods;
    }

    public static function validatePayment(Request $request) {
        $eurConfig = CurrenciesUtils::getCurrencyConfig('eur');
        $minPayment = Settings::get('payments', '_eurMinAmount', $eurConfig['min_payment'], false) / pow(10, $eurConfig['precision']);

        $request->validate([
            'crea_username' => 'required|string',
            'payment_method' => 'required|string|in:card,gpay,apay',
            'token' => 'required|string|in:crea,cbd',
            'fiat_currency' => 'required|string|in:eur,usd',
            'fiat_amount' => "required|numeric|min:$minPayment",
            'email' => 'required|email',
            'name' => 'required|string',
            'surname' => 'required|string',
            'address' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'phone' => 'required|phone:AUTO',
            'birth_date' => 'required|date',
            'zip_code' => 'required|string',
            'check_tos' => 'required',
            'check_username' => 'required',
        ]);

        $paymentMethod = $request->get('payment_method');
        $crypto = $request->get('token');
        $fiat = $request->get('fiat_currency');
        $price = CurrencyPrice::getBuyPrice($crypto, $fiat);

        $fiatAmount = $request->get('fiat_amount');
        $cryptoAmountToSend = $price->fiatToToken($fiatAmount, false);

        $payment = new Payment();
        $payment->method = $paymentMethod;
        $payment->crypto = $crypto;
        $payment->fiat = $fiat;
        $payment->amount = intval($fiatAmount * 100);
        $payment->price = intval($price->fiatToToken(1, false)); //1 TOKEN => X FIAT
        $payment->to_send = intval($cryptoAmountToSend * 1000);
        $payment->send_to = $request->get('crea_username');
        $payment->save();

        $params = $request->except(['payment_method', 'token', 'fiat_currency', 'fiat_amount', 'crea_username', '_token']);
        $params['total'] = ($fiatAmount * 1.029) + 0.25;

        foreach ($params as $k => $value) {
            $paymentMeta = new PaymentMeta();
            $paymentMeta->payment_id = $payment->id;
            $paymentMeta->meta_key = "_$k";
            $paymentMeta->meta_value = $value;
            $paymentMeta->save();
        }

        switch ($paymentMethod) {
            case 'card':
                return self::validateCardPayment($request, $payment);
                break;
            default:
                return self::validateBrowserPayment($request, $payment);

        }
    }

    /**
     * @param Request $request
     * @param Payment $payment
     * @return mixed
     * @throws \Stripe\Exception\ApiErrorException
     */
    public static function validateCardPayment(Request $request, Payment $payment) {

        $total = PaymentMeta::query()
            ->where('payment_id', $payment->id)
            ->where('meta_key', '_total')
            ->first();

        $email = PaymentMeta::query()
            ->where('payment_id', $payment->id)
            ->where('meta_key', '_email')
            ->first();

        $paymentData = [
            'name' => __('crypto.' . $payment->crypto . '.name', [], 'en'),
            'description' => __('crypto.' . $payment->crypto . '.description', [], 'en'),
            'currency' => $request->get('fiat_currency'),
            'amount' => intval($total->meta_value * 100),
            'quantity' => 1,
            'images' => ['https://creary.net/img/logo_creary_beta.svg']
        ];

        //dd($paymentData);
        $session = Session::create([
            'customer_email' => $email->meta_value,
            'payment_method_types' => [$request->get('payment_method')],
            'line_items' => [$paymentData],
            'success_url' => env('APP_URL') . '/payments/process/{CHECKOUT_SESSION_ID}',
            'cancel_url' =>  env('APP_URL') . '/payments/cancel/{CHECKOUT_SESSION_ID}'
        ]);

        $pmSessionId = new PaymentMeta();
        $pmSessionId->payment_id = $payment->id;
        $pmSessionId->meta_key = '_sessionId';
        $pmSessionId->meta_value = $session->id;
        $pmSessionId->save();

        //dd($session);

        return View::make('purchase')
            ->withStripeSession($session);
    }

    public static function validateBrowserPayment(Request $request, Payment $payment) {
        $request->validate([
            'card_ownner' => 'required|string',
            'card_number' => 'required|number',
            'card_date' => 'required|date',
            'card_cvv' => 'required|number|digits:3',
            'card_owner_check' => 'required|boolean',
        ]);
    }
}