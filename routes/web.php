<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Auth::routes(['verify' => true]);

Route::get('/purchase', 'PurchaseController@index')->name('purchase.index');

Route::post('/purchase/buy', 'PurchaseController@purchaseBuy')->name('purchase.buy');

Route::group(['prefix' => 'payments'], function () {
    Route::get('/success/{payment}', 'PurchaseController@successPayment')->name('payments.success');
    Route::get('/error/{payment}', 'PurchaseController@errorPayment')->name('payments.error');
});


Route::get('/home', 'HomeController@index')->name('home');