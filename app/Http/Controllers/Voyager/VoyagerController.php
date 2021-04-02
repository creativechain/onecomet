<?php


namespace App\Http\Controllers\Voyager;


use App\Cash\Truust\TruustWallet;
use TCG\Voyager\Facades\Voyager;

class VoyagerController extends \TCG\Voyager\Http\Controllers\VoyagerController
{

    public function index()
    {
        //$wallet = (new TruustWallet())->data();

        return Voyager::view('voyager::index');
    }
}
