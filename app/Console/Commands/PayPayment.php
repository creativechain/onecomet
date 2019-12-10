<?php

namespace App\Console\Commands;

use App\Jobs\PayJob;
use App\Payment;
use App\PaymentMeta;
use Illuminate\Console\Command;

class PayPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'oc:pay {paymentId} {-I|--no-interactive}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pay a payment';

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
        /**
         * @var Payment $payment
         */
        $payment = Payment::query()->find($paymentId);

        $toSend = $payment->formatToSend();
        $from = env('CREA_SENDER_USER');
        $to = $payment->send_to;
        $wif = env('CREA_SENDER_KEY');

        //dd($this->options());
        if ($payment) {
            if (!$this->option('no-interactive')) {
                if ($payment->status !== 'success') {
                    $continue = $this->ask("WARNING: This payment is in \"$payment->status\" status. Continue? [y/N]");
                    $continue = strtolower($continue);
                    if ($continue !== 'y' && $continue !== 'yes') {
                        return false;
                    }
                }

                $continue = $this->ask("$toSend will be sent to @$to. Continue? [y/N]");
                $continue = strtolower($continue);
                if ($continue !== 'y' && $continue !== 'yes') {
                    return false;
                }
            }

            PayJob::dispatchNow($paymentId);
            /*$error = false;
            $output = [];
            exec("crea-tx transfer $from $to \"$toSend\" $payment->identifier $wif --node https://nodes.creary.net", $output,  $error);

            if (!$error) {
                $output = implode(" ", $output);
                $txData = json_decode($output, true);
                //dd($txData);

                $payment->status = 'paid';
                $payment->save();

                $pTx = new PaymentMeta();
                $pTx->payment_id = $payment->id;
                $pTx->meta_key = '_txid';
                $pTx->meta_value = $txData['id'];
                $pTx->save();

                $pBlock = new PaymentMeta();
                $pBlock->payment_id = $payment->id;
                $pBlock->meta_key = '_block';
                $pBlock->meta_value = $txData['block_num'];
                $pBlock->save();

                $this->info("Payment sent! $toSend to @$to: Result: $output");
                info("Payment sent! $toSend to @$to: Result: $output");
                return true;
            } else {
                error_log("Error sending amount");
                $this->error("Error sending amount");
                return $output;
            }*/

            return true;


        } else {
            error_log("Payment not found: $paymentId");
            $this->error('Payment not found');
            return false;
        }
    }
}
