<?php

namespace App\Http\Controllers;

use App\CurrencyPrice;
use App\Utils\CurrenciesUtils;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $lastPrice = CurrencyPrice::getBuyPrice();
        //TODO: Apply comissions to price

        return view('home')
            ->withLastPrice($lastPrice)
            ->withFiatCurrencies(CurrenciesUtils::getFiatCurrenciesConfig())
            ->withCryptoCurrencies(CurrenciesUtils::getCryptoCurrenciesConfig());
    }
}
