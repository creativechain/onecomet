<?php


namespace App\Jobs;


use App\CurrencyPrice;
use App\Utils\NumberUtils;
use function GuzzleHttp\Psr7\str;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BlockchainPriceUpdater extends PriceUpdater
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * ExratesPriceUpdater constructor.
     * @param $currency
     * @param $counterCurrency
     */
    public function __construct()
    {

        parent::__construct('crea', 'cbd', 'https://nodes.creary.net');
    }

    public function execute()
    {
        $ticker = $this->post('/', [
            "jsonrpc" => "2.0",
            "method" => "condenser_api.get_state",
            "params" => ["/now"],
            "id" => random_int(0, 999999)
        ]);

        //dd($ticker);
        if ($ticker) {
            $ticker = $ticker['result'];
            $feed = $ticker['feed_price'];
            $base = $feed['base'];
            $quote = $feed['quote'];

            if (strpos($base, 'CREA') > 0) {
                //Base is CREA
                //Quote is CBD
                $crea = floatval(substr($base, 0, 5));
                $cbd = floatval(substr($quote, 0, 5));
            } else {
                //Base is CBD
                //Quote is CREA
                $cbd = floatval(substr($base, 0, 5));
                $crea = floatval(substr($quote, 0, 5));
            }

            //Price per 1 Crea
            $price = 1 * $cbd / $crea;


            $counterPrecision = NumberUtils::getDecimalPlaces($price);
            //echo $price . ' ' . $counterPrecision . PHP_EOL;
            $price = $price * pow(10, $counterPrecision);

            $this->savePrice($price, $counterPrecision);

            $creaCbdPrice =  CurrencyPrice::getBuyPrice('crea', 'cbd');
            $oneCbdCrea = $creaCbdPrice->fiatToToken(1);

            //CBD price in EUR
            $creaEurPrice = CurrencyPrice::getBuyPrice('crea', 'eur');
            $oneCbdEur = $creaEurPrice->tokenToFiat($oneCbdCrea);

            $cbdEurPrecision = NumberUtils::getDecimalPlaces($oneCbdEur);
            $cp = new CurrencyPrice();
            $cp->currency = 'CBD';
            $cp->precision = 3;
            $cp->counter_currency = 'EUR';
            $cp->counter_precision =  $cbdEurPrecision;
            $cp->price = $oneCbdEur * pow(10, $cbdEurPrecision);
            $cp->source = $this->apiUrl;
            $cp->save();


            //CBD price in USD
            $creaUsdPrice = CurrencyPrice::getBuyPrice('crea', 'usd');
            $oneCbdUsd = $creaUsdPrice->tokenToFiat($oneCbdCrea);

            $cbdUsdPrecision = NumberUtils::getDecimalPlaces($oneCbdUsd);
            $cp = new CurrencyPrice();
            $cp->currency = 'CBD';
            $cp->precision = 3;
            $cp->counter_currency = 'USD';
            $cp->counter_precision =  $cbdUsdPrecision;
            $cp->price = $oneCbdUsd * pow(10, $cbdUsdPrecision);
            $cp->source = $this->apiUrl;
            $cp->save();

        }

    }
}