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
        $ticker = $this->get('/api/v3/coins/creativecoin/market_chart', array( 'id' => 'creativecoin', 'vs_currency' => strtolower($this->counterCurrency), 'days' => 1));

        if ($ticker) {
            $prices = $ticker['prices'];

            $price = 0;
            foreach ($prices as $p) {
                $price = max($price, $p[1]);
            }

            $counterPrecision = NumberUtils::getDecimalPlaces($price);
            //echo $price . ' ' . $counterPrecision . PHP_EOL;
            $price = $price * pow(10, $counterPrecision);

            $this->savePrice($price, $counterPrecision);

        }

    }
}
