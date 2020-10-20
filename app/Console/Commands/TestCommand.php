<?php

namespace App\Console\Commands;

use App\Jobs\BlockchainPriceUpdater;
use App\Jobs\CGYPriceUpdater;
use App\Jobs\CoingeckoPriceUpdater;
use App\Jobs\ExratesPriceUpdater;
use App\Jobs\PriceUpdater;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'oc:test';

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

        $prefix = phone('+34691891463')->getPhoneNumberInstance()->getCountryCode();
        dd($prefix);
    }
}
