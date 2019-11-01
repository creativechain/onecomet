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
     * @return \Illuminate\Database\Eloquent\Builder|Model|object|null
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