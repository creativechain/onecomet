<?php

namespace App\Http\Controllers;

use App\Cash\Truust\TruustOrder;
use App\Jobs\PayJob;
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

        //Retrieve payment
        /** @var Payment $payment */
        $payment = Payment::query()
            ->where('identifier', $sessionId)
            ->first();

        if (!$payment) {
            $sessionMeta = PaymentMeta::query()
                ->where('meta_value', $sessionId)
                ->first();

            $payment = Payment::query()->find($sessionMeta->payment_id);
        }

        //Se comprueba el estado del pago previamente para saber si hace falta procesarlo
        switch ($payment->status) {
            case 'paid':
            case 'oc_paid':
            case 'published':
            case 'pending_validate':
            case 'pending_release':
            case 'released':
                return View::make('payments.success')
                    ->withPayment($payment);
            case 'canceled':
            case 'failure':
            case 'rejected':
                return View::make('payments.rejected')
                    ->withPayment($payment);
        }

        //Se procede a procesar el pago
        $paymentMetas = $payment->getMetas();

        //Default PaymentGateway is Stripe
        $paymentGateway = 'stripe';

        if ($paymentMetas->has('_payment_gateway')) {
            $paymentGateway = $paymentMetas->get('_payment_gateway');
        }

        //Se obtiene el estado actual del pago
        if ($paymentGateway === 'truust') {
            $order = TruustOrder::viewPayment($payment);
            $paymentStatus = strtolower($order->result->get('status'));
        } else {
            $order = Session::retrieve($sessionId);
            $paymentIntent = PaymentIntent::retrieve($order->payment_intent);
            $paymentStatus = $paymentIntent->status;
        }

        //If payment isn't in succeeded status, return to payment screen
        info("PG : $paymentGateway Status: $paymentStatus");
        switch ($paymentStatus) {
            case 'paid':
            case 'published':
            case 'pending_validate':
            case 'pending_release':
            case 'released':
            case 'succeeded';
                $payment->status = $paymentStatus;
                $payment->save();

                //Accept and validate payment
                $order = TruustOrder::finishPayment($payment);

                //Send amount
                PayJob::dispatch($payment->id)->delay(now()->addSeconds(1));
                /*$exec = Artisan::call('oc:pay', ['paymentId' => $payment->id, '--no-interactive' => true]);*/
                info("Pay Job called");

                return View::make('payments.success')
                    ->withPayment($payment);
            case 'cancelled':
            case 'canceled':
            case 'failure':
            case 'rejected':
            case 'blocked_release':
                $payment->status = $paymentStatus;
                $payment->save();
                return View::make('payments.rejected')
                    ->withPayment($payment);
            default:
                return View::make('purchase')
                    ->withPaymentGateway($paymentGateway)
                    ->withOrder($order);
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
