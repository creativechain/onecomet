<?php


namespace App\Cash\Truust;


use App\Payment;
use App\PaymentMeta;

class TruustWallet extends TruustClient
{

    private $walletId;

    /**
     * TruustWallet constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->walletId = config('cash.truust.wallet_id');
    }

    /**
     * @return mixed
     */
    public function data() {
        return $this->get( "wallets/$this->walletId");
    }

    /**
     * @param Payment $payment
     * @return mixed
     */
    public function createPayin($payment) {

        $metas = $payment->getMetas(true);
        $orderId = $metas->get('_external_id');
        return $this->post([
            'order_id' => $orderId,
            'type' => 'WALLET',
            'wallet_id' => $this->walletId
        ], 'payins');
    }

    /**
     * @param int|float $amount
     * @return Payment
     */
    public function prepareTransfer($amount) {
        //Firs create a payment
        $payment = new Payment();
        $payment->method = 'WALLET';
        $payment->crypto = 'EUR';
        $payment->fiat = 'EUR';
        $payment->amount = intval($amount * 100);
        $payment->price = 100;
        $payment->to_send = 0;
        $payment->send_to = 'crea';
        $payment->save();

        $params = array();
        $params['total'] = $amount;
        $params['payment_gateway'] = config('cash.default');

        $metas = array();
        foreach ($params as $k => $value) {
            $metas[] = array(
                'payment_id' => $payment->id,
                'meta_value' => $value,
                'meta_key' => "_$k",
            );
        }

        PaymentMeta::query()
            ->insert($metas);

        //Create a customer -> must be creativechain
        PaymentMeta::query()
            ->insert([
                'meta_key' => '_customer_id',
                'meta_value' => config('cash.truust.customer_id'),
                'payment_id' => $payment->id
            ]);

        $order = TruustOrder::create($payment);

        $sessionId = $order->internalId;
        $pmSessionId = new PaymentMeta();
        $pmSessionId->payment_id = $payment->id;
        $pmSessionId->meta_key = '_sessionId';
        $pmSessionId->meta_value = $sessionId;
        $pmSessionId->save();

        //Create a Payin
        $payin = $this->createPayin($payment);
        $payin = $payin['data'];

        PaymentMeta::query()
            ->insert([
                'meta_key' => '_direct_link',
                'meta_value' => $payin['direct_link'],
                'payment_id' => $payment->id
            ]);
        return $payment;
    }
}
