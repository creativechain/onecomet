<?php

namespace App\Console\Commands;

use App\Cash\Truust\TruustOrder;
use App\Jobs\PayJob;
use App\Payment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class TruustValidate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'oc:truust {paymentId} {-A|--accept} {-V|--validate}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Accept and/or validate a payment';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $paymentId = $this->argument('paymentId');
        $accept = $this->option('accept');
        $validate = $this->option('validate');

        /**
         * @var Payment $payment
         */
        $payment = Payment::query()->find($paymentId);

        //dd($this->options());
        if ($payment) {

            if ($accept) {
                try {
                    TruustOrder::acceptPayment($payment);
                    $this->output->writeln("Payment #$paymentId accepted!");
                } catch (\Exception $e) {
                    Log::error('Error accepting payment: ' . $e->getMessage(), $e->getTrace());
                    $this->output->error('Error accepting payment: ' . $e->getMessage());
                }
            }

            if ($validate) {
                try {
                    TruustOrder::validatePayment($payment);
                    $this->output->writeln("Payment #$paymentId validated!");
                    $payment->status = 'paid';
                    $payment->save();
                } catch (\Exception $e) {
                    Log::error('Error validating payment: ' . $e->getMessage(), $e->getTrace());
                    $this->output->error('Error validating payment: ' . $e->getMessage());
                }
            }

            return true;


        } else {
            error_log("Payment not found: $paymentId");
            $this->error('Payment not found');
            return false;
        }
    }
}
