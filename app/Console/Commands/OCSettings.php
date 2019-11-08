<?php

namespace App\Console\Commands;

use App\Jobs\CoingeckoPriceUpdater;
use App\Jobs\ExratesPriceUpdater;
use App\Jobs\PriceUpdater;
use App\Settings;
use Illuminate\Console\Command;

class OCSettings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'oc:settings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update price';

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
        //

        //Payments Settings

        $availableFiatSettings = Settings::getAvailableFiat();

        $afs = $this->ask('Set available fiat. Default', $availableFiatSettings->meta_value);
        $availableFiatSettings->meta_value = $afs;
        $availableFiatSettings->save();

        $availableTokenSettings = Settings::getAvailableToken();

        $ats = $this->ask('Set available tokens. Default', $availableTokenSettings->meta_value);
        $availableTokenSettings->meta_value = $ats;
        $availableTokenSettings->save();

        $availableMethodsSettings = Settings::getAvailableMethods();

        $ams = $this->ask('Set available payment methods. Default', $availableMethodsSettings->meta_value);
        $availableMethodsSettings->meta_value = $ams;
        $availableMethodsSettings->save();

        $fiats = explode(',', $afs);
        foreach ($fiats as $f) {
            $minPaymentFiat = Settings::getMinPayment($f);
            $mpf = $this->ask("Set Minimum payment for $f fiat. Default", $minPaymentFiat->meta_value);
            $minPaymentFiat->meta_value = $mpf;
            $minPaymentFiat->save();
        }

        //Fees
        $feeType = Settings::getOCFeeType();

        $ft = $this->ask('Set OC fee type [fixed or variable]. Default', $feeType->meta_value);
        $feeType->meta_value = $ft;
        $feeType->save();

        $feeValue = Settings::getOCFeeValue($ft);

        $fv = $this->ask('Set OC fee value. Must be a integer. Default', $feeValue->meta_value);
        $feeValue->meta_value = $fv;
        $feeValue->save();
    }
}
