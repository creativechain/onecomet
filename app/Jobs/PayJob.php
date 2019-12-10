<?php

namespace App\Jobs;

use App\Payment;
use App\PaymentMeta;
use Doctrine\DBAL\Exception\DatabaseObjectNotFoundException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PayJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $payment;
    private $paymentId;

    /**
     * Create a new job instance.
     *
     * @param $paymentId
     */
    public function __construct($paymentId)
    {
        //
        $this->paymentId = $paymentId;
        $this->payment = Payment::query()->find($paymentId);
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws DatabaseObjectNotFoundException
     */
    public function handle()
    {
        //
        if ($this->payment) {
            $toSend = $this->payment->formatToSend();
            $from = env('CREA_SENDER_USER');
            $to = $this->payment->send_to;
            $wif = env('CREA_SENDER_KEY');
            $identifier = $this->payment->identifier;

            $error = false;
            $output = [];
            exec("crea-tx transfer $from $to \"$toSend\" $identifier $wif --node https://nodes.creary.net", $output,  $error);

            if (!$error) {
                $this->payment->status = 'paid';
                $this->payment->save();

                $output = implode(" ", $output);
                $txData = json_decode($output, true);
                info("Payment sent! $toSend to @$to: Result: $output");
                //dd($txData);

                $pTx = new PaymentMeta();
                $pTx->payment_id = $this->payment->id;
                $pTx->meta_key = '_txid';
                $pTx->meta_value = $txData['id'];
                $pTx->save();

                $pBlock = new PaymentMeta();
                $pBlock->payment_id = $this->payment->id;
                $pBlock->meta_key = '_block';
                $pBlock->meta_value = $txData['block_num'];
                $pBlock->save();


            } else {
                error_log("Error sending amount");
            }
        } else {
            throw new DatabaseObjectNotFoundException("Payment with ID $this->paymentId not found");
        }
    }
}
