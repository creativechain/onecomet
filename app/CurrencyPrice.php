<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CurrencyPrice extends Model
{

    protected $table = 'currency_price';

    protected $hidden = ['created_at', 'source', 'id'];

    /**
     * @param string $currency
     * @param string $counterCurrency
     * @return CurrencyPrice
     */
    public static function getBuyPrice($currency = 'crea', $counterCurrency = 'usd' ) {
        $dateInterval = [Carbon::now()->subHours(24)->toDateTimeString(), Carbon::now()->toDateTimeString()];

        //dd($dateInterval);
        return CurrencyPrice::query()
            ->where('currency', strtoupper($currency))
            ->where('counter_currency', strtoupper($counterCurrency))
            ->whereBetween(DB::raw('DATE(updated_at)'), $dateInterval)
            ->orderBy('price', 'desc')
            ->first();
    }

    /**
     * @param $number
     * @param bool $format
     * @return float|int|string
     */
    public function tokenToFiat($number, $format = true) {
        //CREA ------ EUR
        //1    ------ 0.039
        //X    ------ ????

        $conversion = $number * ($this->price / pow(10, $this->counter_precision));

        if ($format) {
            return number_format($conversion, $this->precision);
        }

        return $conversion;
    }

    /**
     * @param $number
     * @param bool $format
     * @return float|int|string
     */
    public function fiatToToken($number, $format = true) {
        //CREA ------ EUR
        //25.641------ 1
        //?    ------ X

        $conversion = $number *  (1 / ($this->price / pow(10, $this->counter_precision)));

        if ($format) {
            return number_format($conversion, $this->precision);
        }

        return $conversion;
    }
}