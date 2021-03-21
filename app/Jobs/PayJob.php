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
use Illuminate\Support\Facades\Log;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

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
            $nodes = env('OC_NODE_URL');
            $command = "crea-tx transfer $from $to \"$toSend\" $identifier $wif --node $nodes";
            Log::debug("Command: $command");
            exec($command, $output,  $error);

            if (!$error) {
                $this->payment->status = 'oc_paid';
                $this->payment->save();

                $output = implode(" ", $output);
                $txData = json_decode($output, true);
                Log::info("Payment sent! $toSend to @$to: Result: $output");
                //dd($txData);

                PaymentMeta::query()->insert(array (
                    [
                        'payment_id' => $this->payment->id,
                        'meta_key' => '_txid',
                        'meta_value' => $txData['id']
                    ],
                    [
                        'payment_id' => $this->payment->id,
                        'meta_key' => '_block',
                        'meta_value' => $txData['block_num']
                    ],
                ));

            } else {
                Log::error("Error sending amount. Exit Code " . $error);
                if (config('env') !== 'production') {
                    Log::info('App is not in production environment. Simulating success payment... ');
                    $this->payment->status = 'oc_paid';
                    $this->payment->save();
                }
            }
        } else {
            throw new NotFoundResourceException("Payment with ID $this->paymentId not found");
        }
    }
}
