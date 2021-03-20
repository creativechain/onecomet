<?php

namespace App\Jobs;

use App\Cash\Truust\TruustOrder;
use App\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class ProcessPaymentsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //Find unprocessed payments of last 24 hours
        $startDate = Carbon::now()->subDay();
        $endDate = Carbon::now();

        $payments = Payment::query()
            ->where('status', '!=', 'oc_paid')
            ->whereBetween('updated_at', [$startDate, $endDate])
            ->get();

        Log::debug('Processing ' . $payments->count() . ' payments');

        foreach ($payments as $payment) {
            Log::debug('Processing ' . $payment);

            try {
                $order = TruustOrder::viewPayment($payment);
                $paymentStatus = strtolower($order->result->get('status'));

                $payment->status = $paymentStatus;
                $payment->save();

                switch ($paymentStatus) {
                    case 'paid':
                    case 'published':
                    case 'pending_validate':
                    case 'pending_release':
                    case 'released':
                    case 'succeeded';
                        //Accept and validate payment
                        $order = TruustOrder::finishPayment($payment);

                        //Send amount
                        PayJob::dispatch($payment->id)->delay(now()->addSeconds(1));
                        /*$exec = Artisan::call('oc:pay', ['paymentId' => $payment->id, '--no-interactive' => true]);*/
                        info("Launch pay job for payment " . $payment . '. Real status: ' . $paymentStatus);
                        break;
                    case 'cancelled':
                    case 'canceled':
                    case 'failure':
                    case 'rejected':
                    case 'blocked_release':
                        Log::info("Payment " . $payment . ' rejected. Real status: ' . $paymentStatus);
                }
            } catch (\Exception $e) {
                Log::error('Error processing payment ' . $payment, $e->getTrace());
            }
        }
    }
}
