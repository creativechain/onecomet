<?php


namespace App\Utils;


use App\Settings;

class CurrenciesUtils
{

    /**
     * @return array
     */
    public static function getAvailableFiatCurrencies() {
        return explode(',', env('OC_AVAILABLE_FIAT_CURRENCIES'));
    }

    /**
     * @return array
     */
    public static function getAvailableCryptoCurrencies() {
        return explode(',', env('OC_AVAILABLE_CURRENCIES'));
    }

    private static function getCurrenciesSymbols($currencies) {
        $cConfig = [];

        foreach ($currencies as $c) {
            $config = config("currencies.$c");
            $cConfig[$c] = $config['symbol'];
        }

        return $cConfig;
    }

    /**
     * @param $currency
     * @return \Illuminate\Config\Repository|mixed
     */
    public static function getCurrencyConfig($currency) {
        $config = config("currencies.$currency");
        $min = Settings::get('payment', $currency.'MinAmount', $config['min_payment']);
        $max = Settings::get('payment', $currency.'MaxAmount', $config['max_payment']);
        $config['min_unit'] = $min / (pow(10, $config['precision']));
        $config['max_unit'] = $max / (pow(10, $config['precision']));
        $config['name'] = $currency;
        return $config;
    }

    public static function getCryptoCurrenciesConfig() {
        return self::getCurrenciesSymbols(self::getAvailableCryptoCurrencies());
    }

    public static function getFiatCurrenciesConfig() {
        return self::getCurrenciesSymbols(self::getAvailableFiatCurrencies());
    }
}