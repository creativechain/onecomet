<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Stripe\Stripe;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $request = request();

        $lang = $request->cookie('lang');

        if (!$lang) {
            $lang = $request->getPreferredLanguage(['en', 'es']);
            if (!$lang) {
                $lang = 'en';
            }
        }

        App::setLocale($lang);
        Schema::defaultStringLength(191);
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
    }
}
