<?php


namespace App;


use App\Utils\CurrenciesUtils;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{

    protected $table = 'oc_settings';

    /**
     * @param $type
     * @param $key
     * @param null $default
     * @param bool $obj
     * @return bool|\Illuminate\Database\Eloquent\Builder|Model|mixed|object|null
     */
    public static function get($type, $key, $default = null, $obj = false) {
        $value = Settings::query()
            ->where('type', $type)
            ->where('meta_key', $key)
            ->first();

        if ($value) {
            if ($obj) {
                return $value;
            }

            return $value->meta_value;
        }

        if ($obj) {
            $s = new Settings();
            $s->type = $type;
            $s->meta_key = $key;
            $s->meta_value = $default;
            return $s;
        }

        return $default;
    }

    /**
     * @return bool|\Illuminate\Database\Eloquent\Builder|Model|mixed|object|null
     */
    public static function getAvailableFiat() {
        return self::get('payments', '_availableFiat', env('OC_AVAILABLE_FIAT_CURRENCIES'), true);
    }

    /**
     * @return bool|\Illuminate\Database\Eloquent\Builder|Model|mixed|object|null
     */
    public static function getAvailableToken() {
        return self::get('payments', '_availableToken', env('OC_AVAILABLE_CURRENCIES'), true);
    }

    /**
     * @return array
     */
    public static function getAvailableTokenSymbols() {
        $tokens =  self::get('payments', '_availableToken', env('OC_AVAILABLE_CURRENCIES'));
        $tokens = explode(',', $tokens);
        return CurrenciesUtils::getCurrenciesSymbols($tokens);
    }


    /**
     * @return bool|\Illuminate\Database\Eloquent\Builder|Model|mixed|object|null
     */
    public static function getAvailableMethods() {
        return self::get('payments', '_availableMethods', env('OC_AVAILABLE_PAYMENT_METHODS'), true);
    }

    /**
     * @param $fiat
     * @return bool|\Illuminate\Database\Eloquent\Builder|Model|mixed|object|null
     */
    public static function getMinPayment($fiat) {
        $fiatConfig = CurrenciesUtils::getCurrencyConfig($fiat);
        return self::get('payments', "_$fiat" . "MinAmount", $fiatConfig['min_payment'], true);

    }

    /**
     * @param $fiat
     * @return bool|\Illuminate\Database\Eloquent\Builder|Model|mixed|object|null
     */
    public static function getMaxPayment($fiat) {
        $fiatConfig = CurrenciesUtils::getCurrencyConfig($fiat);
        return self::get('payments', "_$fiat" . "MaxAmount", $fiatConfig['max_payment'], true);

    }

    /**
     * @param $fiat
     * @return bool|\Illuminate\Database\Eloquent\Builder|Model|mixed|object|null
     */
    public static function getOCFeeType() {
        return self::get('fees', "_feeType", 'variable', true);
    }

    /**
     * @param $type
     * @return bool|\Illuminate\Database\Eloquent\Builder|Model|mixed|object|null
     */
    public static function getOCFeeValue($type) {
        return self::get('fees', "_$type" . "FeeValue", 2, true);
    }
}