<?php

namespace App\Console\Commands;

use App\Jobs\BlockchainPriceUpdater;
use App\Jobs\CoingeckoPriceUpdater;
use App\Jobs\ExratesPriceUpdater;
use App\Jobs\PriceUpdater;
use Illuminate\Console\Command;

class UpdatePrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'oc:update-price';

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
        //Exrates
        //ExratesPriceUpdater::dispatch('crea', 'btc')->delay(now()->addSeconds(10));
        //ExratesPriceUpdater::dispatch('crea', 'usd')->delay(now()->addSeconds(10));

        //Coingecko
        CoingeckoPriceUpdater::dispatch('crea', 'btc')->delay(now()->addSeconds(10));
        CoingeckoPriceUpdater::dispatch('crea', 'usd')->delay(now()->addSeconds(10));
        CoingeckoPriceUpdater::dispatch('crea', 'eur')->delay(now()->addSeconds(10));
        BlockchainPriceUpdater::dispatch()->delay(now()->addSeconds(10));
    }
}
