<?php


namespace App\Jobs;


use App\Utils\NumberUtils;
use function GuzzleHttp\Psr7\str;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CoingeckoPriceUpdater extends PriceUpdater
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * ExratesPriceUpdater constructor.
     * @param $currency
     * @param $counterCurrency
     */
    public function __construct($currency, $counterCurrency)
    {

        parent::__construct($currency, $counterCurrency, 'https://api.coingecko.com');
    }

    public function execute()
    {
        $ticker = $this->get('/api/v3/simple/price', array( 'ids' => 'creativecoin', 'vs_currencies' => strtolower($this->counterCurrency)));

        //dd($ticker);
        if ($ticker) {
            $ticker = $ticker['creativecoin'];
            $price = $ticker[strtolower($this->counterCurrency)];
            $counterPrecision = NumberUtils::getDecimalPlaces($price);
            //echo $price . ' ' . $counterPrecision . PHP_EOL;
            $price = $price * pow(10, $counterPrecision);

            $this->savePrice($price, $counterPrecision);

        }

    }
}