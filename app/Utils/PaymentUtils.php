<?php


namespace App\Utils;


class PaymentUtils
{

    /**
     * @return array
     */
    public static function getAvailableMethods() {
        return explode(',', env('OC_AVAILABLE_PAYMENT_METHODS'));
    }

    /**
     * @return array
     */
    public static function getTranslatedAvailableMethods() {
        $methods = self::getAvailableMethods();

        $tMethods = [];
        foreach ($methods as $m) {
            $tMethods[$m] = trans("payments.type.$m");
        }

        return $tMethods;
    }
}