<?php

namespace App\Http\Controllers;

use App\CurrencyPrice;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('summary');
    }

    public function getPrice(Request $request, $currency, $counterCurrency) {
        $price = CurrencyPrice::getBuyPrice($currency, $counterCurrency);

        return response($price);
    }
}
