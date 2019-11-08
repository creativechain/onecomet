<?php

namespace App\Http\Controllers;

use App\CurrencyPrice;
use Illuminate\Http\Request;
use Stripe\PaymentIntent;

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

    public function webPay(Request $request) {
        $request->validate([
            'crea_user' => 'required|string',
            'payment_method' => 'required|string|in:card,gpay,apay',
            'token' => 'required|string|in:crea,cbd',
            'fiat_currency' => 'required|string|in:eur,usd',
            'fiat_amount' => 'required|numeric|min:10',
            'price' => 'required|numeric'
        ]);

        $paymentIntent = PaymentIntent::create([
            'amount' => $request->get('fiat_amount'),
            'currency' => $request->get('eur'),
        ]);

        return response($paymentIntent);
    }
}
