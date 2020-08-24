<?php


namespace App\Cash\Truust;


class TruustWallet extends TruustClient
{

    private $walletId;

    /**
     * TruustWallet constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->walletId = config('cash.truust.wallet_id');
    }

    /**
     * @return mixed
     */
    public function data() {
        return $this->get( "wallets/$this->walletId");
    }


}
