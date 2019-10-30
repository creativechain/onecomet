<?php


namespace App\Jobs;


use App\Utils\NumberUtils;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExratesPriceUpdater extends PriceUpdater
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * ExratesPriceUpdater constructor.
     * @param $currency
     * @param $counterCurrency
     */
    public function __construct($currency, $counterCurrency)
    {

        parent::__construct($currency, $counterCurrency, 'https://api.exrates.me');
    }

    public function execute()
    {
        $currencyPair = $this->getPair();
        $ticker = $this->get('/openapi/v1/public/ticker', array( 'currency_pair' => $currencyPair));

        if ($ticker) {
            $ticker = $ticker[0];
            $price = $ticker['last'];
            $counterPrecision = NumberUtils::getDecimalPlaces($price);
            echo $price . ' ' . $counterPrecision . PHP_EOL;
            $price = $price * pow(10, $counterPrecision);

            $this->savePrice($price, $counterPrecision);
        }

    }
}