<?php

namespace App\Http\Controllers;

use App\Cash\Truust\TruustOrder;
use App\Jobs\PayJob;
use App\Payment;
use App\PaymentMeta;
use App\Utils\PaymentUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Stripe\Checkout\Session;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use Stripe\SetupIntent;

class PurchaseController extends Controller
{

    /**
     * @param Request $request
     * @return mixed|void
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function purchaseBuy(Request $request) {
        return PaymentUtils::validatePayment($request);
    }

    /**
     * @param $sessionId
     * @return \Illuminate\Contracts\View\View
     */
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

        switch ($payment->status) {
            case 'paid':
            case 'oc_paid':
            case 'published':
            case 'pending_validate':
            case 'pending_release':
            case 'released':
                return View::make('payments.success')
                    ->with('payment', $payment);
            case 'canceled':
            case 'failure':
            case 'rejected':
            default:
                return View::make('payments.rejected')
                    ->with( 'payment', $payment);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function statusPayment(Request $request) {

        $data = $request->input();

        Log::debug('Webhook', $data);

        $paymentData = $data[0]['escrow'];

        $paymentMeta = PaymentMeta::query()
            ->where('meta_key', '_external_id')
            ->where('meta_value', $paymentData['id'])
            ->first();

        if ($paymentMeta) {
            /** @var Payment $payment */
            $payment = Payment::query()
                ->findOrFail($paymentMeta->payment_id);

            Log::debug('Webhook caught. Processing ' . $payment);
            //Se comprueba el estado del pago previamente para saber si hace falta procesarlo
            if ($payment->status === 'oc_paid') {
                return response()->json([
                    'status' => 'processed',
                    'message' => 'Payment already processed'
                ]);
            }

            $payment->status = strtolower($paymentMeta['status']);
            $payment->save();

            Log::debug('Executing PayJob for ' . $payment);
            if ($payment->status === 'published') {
                PayJob::dispatch($payment->id);
            } else {
                Log::debug('Not pay payment because is ' . $payment);
            }
        } else {
            Log::error('No payment_meta recorded for orderId: ' . $paymentData['id']);
            return response()
                ->json([
                    'status' => 'error',
                    'message' => 'Unknown payment'
                ], 404);
        }

        return response()
            ->json([
                'status' => 'ok',
                'message' => 'Payment event processed'
            ]);
    }
}
