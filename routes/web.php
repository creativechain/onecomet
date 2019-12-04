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


Route::get('/', 'HomeController@index')->name('home');
Route::get('/tos', 'HomeController@tos')->name('tos');
Route::get('/privacy', 'HomeController@privacy')->name('privacy');

Auth::routes(['verify' => true]);

Route::get('/purchase', 'PurchaseController@index')->name('purchase.index');

Route::post('/purchase/buy', 'PurchaseController@purchaseBuy')->name('purchase.buy');

Route::group(['prefix' => 'payments'], function () {
    Route::get('/process/{sessionId}', 'PurchaseController@processPayment')->name('payments.process');
    Route::get('/cancel/{sessionId}', 'PurchaseController@cancelPayment')->name('payments.cancel');
});

Route::get('/address', 'AddressController@index')->name('address');
Route::get('/buyer', 'BuyerController@index')->name('buyer');
Route::get('/summary', 'SummaryController@index')->name('summary');
Route::get('/congratulation', 'CongratulationController@index')->name('congratulations');


Route::get('/test', 'TestController@index')->name('test');