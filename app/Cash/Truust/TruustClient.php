<?php


namespace App\Cash\Truust;


use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class TruustClient
{
    private $url = 'https://api-sandbox.truust.io/2.0/';
    private $public_key;
    private $secret_key;
    private $endpoint;

    /**
     * Truust constructor.
     */
    public function __construct()
    {
        if (config('app.env') === 'production') {
            $this->url = 'https://api.truust.io/2.0/';
        }

        $this->public_key = config('cash.truust.public_key');
        $this->secret_key = config('cash.truust.secret_key');
    }

    /**
     * @param array $data
     * @param $endpoint
     * @return mixed
     */
    protected function post($data, $endpoint) {
        $client = new Client();

        $requestConfig = [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => "Bearer $this->secret_key",
            ],
            'json' => $data
        ];

        $response = $client->post("$this->url$endpoint", $requestConfig);

        if ($response->getStatusCode() > 299) {
            throw new \RuntimeException('Truust error:' . $response->getBody());
        }

        $content = $response->getBody()->getContents();
        //Esta linea es necesaria para poder decodificar el json
        $content = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $content);

        $result = json_decode( $content, true );

        Log::debug('TruustClient - ', $result);

        return $result;
    }

    /**
     * @param array $data
     * @param $endpoint
     * @return mixed
     */
    protected function get($data, $endpoint) {
        $client = new Client();

        $requestConfig = [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => "Bearer $this->secret_key",
            ],
            'json' => $data
        ];

        $response = $client->get("$this->url$endpoint", $requestConfig);

        if ($response->getStatusCode() > 299) {
            throw new \RuntimeException('Truust error:' . $response->getBody());
        }

        $content = $response->getBody()->getContents();
        //Esta linea es necesaria para poder decodificar el json
        $content = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $content);

        $result = json_decode( $content, true );

        Log::debug('TruustClient - ', $result);

        return $result;
    }

}
