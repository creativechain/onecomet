<?php

namespace App\Http\Controllers;

use App\CurrencyPrice;
use App\Settings;
use App\Utils\CurrenciesUtils;
use App\Utils\PaymentUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $lastPrice = CurrencyPrice::getBuyPrice('crea', 'eur');
        //TODO: Apply comissions to price

        $eurConfig = CurrenciesUtils::getCurrencyConfig('eur');
        $feeType = Settings::get('fees', '_feeType', 'variable');
        $settings = [
            'min_payment' => Settings::get('payments', '_eurMinAmount', $eurConfig['min_payment'], false),
            'feeType' => $feeType,
            'fee' => Settings::get('fees', "_$feeType" . "FeeValue", 2),
        ];

        //dd($lastPrice);
        //dd($methods);
        return view('home')
            ->withLastPrice($lastPrice)
            ->withFiat($eurConfig)
            ->withSettings($settings)
            ->withPaymentMethods(PaymentUtils::getTranslatedAvailableMethods())
            ->withFiatCurrencies(CurrenciesUtils::getFiatCurrenciesConfig())
            ->withCryptoCurrencies(Settings::getAvailableTokenSymbols());
    }

    public function tos() {
        return view('tos');
    }

    public function privacy()
    {
        return view('privacy');
    }
}
