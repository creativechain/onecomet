<?php


namespace App\Utils;


class NumberUtils
{
    /**
     * @param $number
     * @param int $precision
     * @param string $decimalChar
     * @param string $thounsands_sep
     * @return string
     */
    public static function format($number, $precision = 0, $decimalChar = '.', $thounsands_sep = ',') {
        return number_format($number, $precision, $decimalChar, $thounsands_sep);
    }

    /**
     * @param $number
     * @param string $decimalChar
     * @param int $maxDecimals
     * @return int
     */
    public static function getDecimalPlaces($number, $maxDecimals = 8, $decimalChar = '.') {

        $numberString = NumberUtils::format($number, $maxDecimals, $decimalChar);
        $decimalN = explode($decimalChar, $numberString)[1];

        $decimalPlaces = 0;
        for ($x = 0; $x < $maxDecimals; $x++) {
            $n = intval(substr($decimalN, $x, strlen($decimalN)));
            if ($n === 0) {
                break;
            }

            $decimalPlaces++;
        }

        return $decimalPlaces;

    }
}