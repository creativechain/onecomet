<?php


namespace App\Cash\Truust;


use App\Payment;
use App\PaymentMeta;
use Illuminate\Support\Str;
use Propaganistas\LaravelPhone\PhoneNumber;

class TruustCustomer extends TruustClient
{

    /**
     * @var Payment
     */
    private $payment;

    /**
     * TruustCustomer constructor.
     * @param Payment $payment
     */
    public function __construct(Payment $payment)
    {
        parent::__construct();
        $this->payment = $payment;
    }

    public function create() {
        $metas = $this->payment->getMetas();
        $prefix = phone($metas->get('_phone'))->getPhoneNumberInstance()->getCountryCode();
        $phone = $metas->get('_phone');
        //Hay que poner delate el signo +
        $phone = Str::replaceFirst("+$prefix", '', $phone);
        $data = [
            'name' => $metas->get('_name') . ' ' . $metas->get('_surname'),
            'email' => $metas->get('_email'),
            'prefix' => "+$prefix",
            'phone' => $phone,
            'tag' => $this->payment->send_to
        ];

        $this->setResult($this->post($data, 'customers'));

        PaymentMeta::query()
            ->insert([
                'meta_key' => '_customer_id',
                'meta_value' => $this->result->get('id'),
                'payment_id' => $this->payment->id
            ]);
    }

}
