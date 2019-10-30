<?php


namespace App\Utils;


class CurrenciesUtils
{

    /**
     * @return array
     */
    public static function getAvailableFiatCurrencies() {
        return explode(',', env('CREA_AVAILABLE_FIAT_CURRENCIES'));
    }

    /**
     * @return array
     */
    public static function getAvailableCryptoCurrencies() {
        return explode(',', env('CREA_AVAILABLE_CURRENCIES'));
    }

    private static function getCurrenciesConfig($currencies) {
        $cConfig = [];

        foreach ($currencies as $c) {
            $config = config("currencies.$c");
            $cConfig[$c] = $config['symbol'];
        }

        return $cConfig;
    }

    public static function getCryptoCurrenciesConfig() {
        return self::getCurrenciesConfig(self::getAvailableCryptoCurrencies());
    }

    public static function getFiatCurrenciesConfig() {
        return self::getCurrenciesConfig(self::getAvailableFiatCurrencies());
    }
}