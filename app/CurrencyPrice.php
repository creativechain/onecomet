<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CurrencyPrice extends Model
{

    protected $table = 'currency_price';

    /**
     * @param string $currency
     * @param string $counterCurrency
     * @return mixed
     */
    public static function getBuyPrice($currency = 'crea', $counterCurrency = 'usd' ) {
        $dateInterval = [Carbon::now()->subHours(24), Carbon::now()];

        return CurrencyPrice::query()
            ->where('currency', strtoupper($currency))
            ->where('counter_currency', strtoupper($counterCurrency))
            ->whereBetween(DB::raw('DATE(updated_at)'), $dateInterval)
            ->orderBy('price', 'desc')
            ->first();
    }

    public function convert($number) {
        return number_format($number / ($this->price / pow(10, $this->counter_precision)), $this->precision);
    }
}