<?php

namespace App\Console\Commands;

use App\Cash\Truust\TruustOrder;
use App\Cash\Truust\TruustWallet;
use App\Jobs\PayJob;
use App\Payment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class TruustWalletCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'oc:wallet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sen wallet amount ot Crea Bank Account';

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
        $tWallet = new TruustWallet();
        $wallet = $tWallet->data()['data'];

        $balance = $wallet['balance'] . ' ' . $wallet['currency'];
        $continue = $this->ask("WARNING: Send $balance to bank account? [Y/n]");
        $continue = strtolower($continue);
        if ($continue !== 'y' && $continue !== 'yes') {
            return false;
        }

        $payment = $tWallet->prepareTransfer($wallet['balance']);
        $metas = $payment->getMetas(true);
        $directLink = $metas['_direct_link'];
        $this->ask("Please, to continue got to: $directLink and pres [Enter].");

        //$order = TruustOrder::finishPayment($payment);

        $this->getOutput()->success("Transferred $balance.");
    }
}
