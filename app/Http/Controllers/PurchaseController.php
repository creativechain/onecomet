<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Stripe\Checkout\Session;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use Stripe\SetupIntent;

class PurchaseController extends Controller
{
    //

    public function index(Request $request) {
        return View::make('home');
    }

    public function purchaseBuy(Request $request) {
        $request->validate([
            'crea_user' => 'required|string',
            'payment_method' => 'required|string|in:card,bank',
            'crypto_currency' => 'required|string|in:crea,cbd',
            'fiat_currency' => 'required|string|in:eur,usd',
            'fiat_amount' => 'required|numeric|min:10',
            'price' => 'required|numeric'
        ]);

        $crypto = $request->get('crypto_currency');
        $price = $request->get('price');
        $fiatAmount = $request->get('fiat_amount');

        $cryptoAmountToSend = number_format($fiatAmount / $price, 3, '.', '');
        //dd($crypto, $price, $fiatAmount, $cryptoAmountToSend);
        $paymentData = [
            'name' => __('crypto.' . $crypto . '.name', [], 'en'),
            'description' => __('crypto.' . $crypto . '.description', [], 'en'),
            'currency' => $request->get('fiat_currency'),
            'amount' => intval($request->get('fiat_amount') * 100),
            'quantity' => 1,
            'images' => ['https://creary.net/img/logo_creary_beta.svg']
        ];

        //dd($paymentData);
        $session = Session::create([
            'payment_method_types' => [$request->get('payment_method')],
            'line_items' => [$paymentData],
            'success_url' => env('APP_URL') . '/payments/success/{CHECKOUT_SESSION_ID}',
            'cancel_url' =>  env('APP_URL') . '/payments/cancel/{CHECKOUT_SESSION_ID}'
        ]);

        $payment = new Payment();
        $payment->session_id = $session->id;
        $payment->method = $request->get('payment_method');
        $payment->crypto = $request->get('crypto_currency');
        $payment->fiat = $request->get('fiat_currency');
        $payment->amount = intval($fiatAmount * 100);
        $payment->price = intval($request->get('price') * 100);
        $payment->to_send = intval($cryptoAmountToSend * 1000);
        $payment->send_to = $request->get('crea_user');
        $payment->save();

        //dd($session);

        return View::make('purchase')
            ->withStripeSession($session);
    }

    public function successPayment(Payment $payment) {

        //dd($payment);
        $session = Session::retrieve($payment->session_id);
        $setUpIntent = SetupIntent::retrieve($session->setup_intent);
        $paymentMethod = PaymentMethod::retrieve($setUpIntent->payment_method);

        if ($payment->status === 'created') {
            $payment->status = 'success';
            $payment->save();

            return View::make('payments.success')
                ->withPayment($payment);
        } else {
            return View::make('payments.rejected');
        }

    }

    public function errorPayment(Request $request, Payment $payment) {

        if ($payment->status === 'created') {
            $payment->status = 'error';
            $payment->save();

            return View::make('payments.error')
                ->withPayment($payment);
        } else {
            return View::make('payments.rejected');
        }

    }
}
