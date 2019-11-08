<?php

namespace App\Http\Controllers;

use App\Payment;
use App\PaymentMeta;
use App\Utils\PaymentUtils;
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
        return View::make('test');
    }

    public function purchaseBuy(Request $request) {
        return PaymentUtils::validatePayment($request);
    }

    public function successPayment($sessionId) {

        //dd($payment);
        //$session = Session::retrieve($sessionId);
        //$setUpIntent = SetupIntent::retrieve($session->setup_intent);
        //$paymentMethod = PaymentMethod::retrieve($setUpIntent->payment_method);

        $paymentMeta = PaymentMeta::query()
            ->where('meta_value', $sessionId)
            ->first();
        $payment = Payment::query()->find($paymentMeta->payment_id);

        if ($payment && $payment->status === 'created') {
            $payment->status = 'success';
            $payment->save();

            return View::make('payments.success')
                ->withPayment($payment);
        } else {
            return View::make('payments.rejected');
        }

    }

    public function errorPayment(Request $request, $sessionId) {

        $paymentMeta = PaymentMeta::query()
            ->where('meta_value', $sessionId)
            ->first();
        $payment = Payment::query()->find($paymentMeta->payment_id);

        if ($payment && $payment->status === 'created') {
            $payment->status = 'error';
            $payment->save();

            return View::make('payments.error')
                ->withPayment($payment);
        } else {
            return View::make('payments.rejected');
        }

    }
}
