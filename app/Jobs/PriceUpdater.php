<?php

namespace App\Jobs;

use App\CurrencyPrice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

abstract class PriceUpdater implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $currency;
    protected $counterCurrency;
    protected $apiUrl;

    /**
     * Create a new job instance.
     *
     * @param $currency
     * @param $counterCurrency
     * @param $apiUrl
     */
    public function __construct($currency, $counterCurrency, $apiUrl)
    {
        $this->currency = $currency;
        $this->counterCurrency = $counterCurrency;
        $this->apiUrl = $apiUrl;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return mixed
     */
    public function getCounterCurrency()
    {
        return $this->counterCurrency;
    }

    /**
     * @return mixed
     */
    public function getApiUrl()
    {
        return $this->apiUrl;
    }


    /**
     * @param $endpoint
     * @param $params
     * @return mixed|null
     */
    protected function get($endpoint, $params) {
        $url = $this->apiUrl . $endpoint;

        if ($params) {
            $url .= '?';
            $first = false;
            foreach ($params as $key => $val) {
                if ($first) {
                    $url .= '&';
                }

                $url .= $key . '=';
                $url .= urlencode($val);
                $first = true;
            }
        }

        //dd($url);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            dd($err);
            return null;
        } else {
            return json_decode($response, true);
        }
    }

    /**
     * @param $endpoint
     * @param $params
     * @return mixed|null
     */
    protected function post($endpoint, $params) {
        $url = $this->apiUrl . $endpoint;

        //dd($url);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($params),
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            dd($err);
            return null;
        } else {
            return json_decode($response, true);
        }
    }

    /**
     * @return string
     */
    protected function getPair() {
        return strtolower($this->currency) . '_' . strtolower($this->counterCurrency);
    }

    /**
     * @param $counterPrice
     * @return CurrencyPrice
     */
    protected function savePrice($counterPrice, $counterPrecision) {
        $cp = new CurrencyPrice();
        $cp->currency = strtoupper(config('currencies.' . $this->currency. '.symbol'));
        $cp->precision = config('currencies.' . strtolower($this->currency).'.precision');
        $cp->counter_currency = strtoupper($this->counterCurrency);
        $cp->counter_precision = $counterPrecision;
        $cp->price = $counterPrice;
        $cp->source = $this->apiUrl;
        $cp->save();
        return $cp;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->execute();
    }

    public abstract function execute();
}
