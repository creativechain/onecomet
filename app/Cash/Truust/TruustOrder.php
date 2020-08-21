<?php


namespace App\Cash\Truust;

use App\Payment;
use App\PaymentMeta;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class TruustOrder extends TruustClient
{
    /**
     * @var Payment
     */
    private $payment;

    /**
     * @var string
     */
    public $internalId;

    /**
     * @var Collection
     */
    public $result;

    /**
     * TruustOrder constructor.
     * @param Payment $payment
     */
    private function __construct($payment)
    {
        parent::__construct();

        $this->payment = $payment;
        $this->internalId = $payment->identifier;
    }

    /**
     * @param $result
     * @return Collection
     */
    private function setResult($result) {
        $result = collect($result['data']);
        $this->result = $result;
        return $result;
    }

    public function send() {
        $metas = PaymentMeta::query()
            ->where('payment_id', $this->payment->id)
            ->get()
            ->pluck('meta_value', 'meta_key');

        $notificationUrl = config('app.url') . "/payments/process/$this->internalId";
        $cryptoName =  __('crypto.' . $this->payment->crypto . '.name', [], 'en');
        $paymentData = [
            'name' => "Onecomet $cryptoName $this->internalId",
            'value' => $metas->get('_total'),
            'images' => ['https://creary.net/img/logo_creary_beta.svg'],
            'buyer_id' => config('cash.truust.customer_id'),
            'seller_id' => config('cash.truust.customer_id'),
            'buyer_confirmed_url' => $notificationUrl,
            'buyer_denied_url' => $notificationUrl,
            'seller_confirmed_url' => $notificationUrl,
            'seller_denied_url' => $notificationUrl,
            'fee_percent' => 2.8
        ];

        $result = $this->setResult($this->post($paymentData, 'orders'));

        PaymentMeta::query()->insert(array (
            [
                'payment_id' => $this->payment->id,
                'meta_key' => '_external_id',
                'meta_value' => $result->get('id')
            ],
            [
                'payment_id' => $this->payment->id,
                'meta_key' => '_public_id',
                'meta_value' => $result->get('public_id')
            ],
        ));

    }

    public function accept() {
        $truustId = $this->payment->getMetas()->get('_external_id');
        $this->setResult($this->post([], "orders/$truustId/accept"));

    }

    public function validate() {
        //For validate order, first, create a payout
        $truustId = $this->payment->getMetas()->get('_external_id');
        $this->setResult($this->post([
            'type' => 'WALLET',
            'wallet_id' => config('cash.truust.wallet_id'),
            'order_id' => $truustId
        ], "payouts"));

        //Then, valdiate order
        $this->setResult($this->post([], "orders/$truustId/validate"));

    }

    public function view() {
        $truustId = $this->payment->getMetas()->get('_external_id');
        $this->setResult($this->get([], "orders/$truustId"));
    }

    /**
     * @param Payment $payment
     * @return TruustOrder
     */
    public static function create($payment) {
        $order = new TruustOrder($payment);
        $order->send();

        return $order;
    }

    /**
     * @param $payment
     * @return TruustOrder
     */
    public static function viewPayment($payment) {
        $order = new TruustOrder($payment);
        $order->view();

        return $order;
    }

    /**
     * @param $payment
     * @return TruustOrder
     */
    public static function acceptPayment($payment) {
        $order = new TruustOrder($payment);
        $order->accept();

        return $order;
    }

    /**
     * @param $payment
     * @return TruustOrder
     */
    public static function validatePayment($payment) {
        $order = new TruustOrder($payment);
        $order->validate();

        return $order;
    }

    /**
     * @param $payment
     * @return TruustOrder
     */
    public static function finishPayment($payment) {
        $order = new TruustOrder($payment);
        $order->accept();
        $order->validate();

        return $order;
    }
}
