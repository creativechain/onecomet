<?php


namespace App\Jobs;


use App\Utils\NumberUtils;
use function GuzzleHttp\Psr7\str;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CGYPriceUpdater extends PriceUpdater
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * ExratesPriceUpdater constructor.
     * @param $currency
     * @param $counterCurrency
     */
    public function __construct($counterCurrency)
    {

        parent::__construct('cgy', $counterCurrency, 'localhost');
    }

    public function execute()
    {
        $price = 0.003;
        $counterPrecision = NumberUtils::getDecimalPlaces($price);
        $price = $price * pow(10, $counterPrecision);
        $this->savePrice($price, $counterPrecision);
    }
}
