<?php

namespace App\Http\Controllers;

use App\Payment;
use App\PaymentMeta;
use App\Utils\PaymentUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
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

    public function processPayment($sessionId) {

        //Check if user was paid
        $session = Session::retrieve($sessionId);
        $paymentIntent = PaymentIntent::retrieve($session->payment_intent);
        $pmSession = PaymentMeta::query()
            ->where('meta_value', $sessionId)
            ->first();

        $payment = Payment::query()->find($pmSession->payment_id);

        switch ($payment->status) {
            case 'paid':
                return View::make('payments.success')
                    ->withPayment($payment);
            case 'canceled':
                return View::make('payments.rejected')
                    ->withPayment($payment);
        }

        //If payment isn't in succeeded status, return to payment screen
        switch ($paymentIntent->status) {
            case 'succeeded';
                $payment->status = 'success';
                $payment->save();

                //Send amount
                Artisan::call('oc:pay', ['paymentId' => $payment->id, '--no-interactive' => false]);

                return View::make('payments.success')
                    ->withPayment($payment);
            case 'canceled':
                $payment->status = 'canceled';
                $payment->save();
                return View::make('payments.rejected')
                    ->withPayment($payment);
            default:
                return View::make('purchase')
                    ->withStripeSession($session);
        }
    }

    public function cancelPayment(Request $request, $sessionId) {
        //Cancel payment
        $paymentMeta = PaymentMeta::query()
            ->where('meta_value', $sessionId)
            ->first();
        $session = Session::retrieve($sessionId);
        $paymentIntent = PaymentIntent::retrieve($session->payment_intent);

        //Only cancel this payment if it is not in 'succeeded' or 'canceled' status
        if ($paymentIntent->status === 'succeeded' || $paymentIntent->status === 'canceled') {
            return View::make('payments.rejected');
        }

        $paymentIntent->cancel();

        $payment = Payment::query()->find($paymentMeta->payment_id);
        $payment->status = 'canceled';
        $payment->save();

        return View::make('payments.canceled')
            ->withPayment($payment);

    }
}
