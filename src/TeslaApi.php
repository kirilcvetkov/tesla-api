<?php

namespace KirilCvetkov\TeslaApi;

use GuzzleHttp\Client;

class TeslaApi
{
    public function __construct(private readonly string $token)
    {
    }

    public function products()
    {
        $response = (new Client())->request('GET', 'https://owner-api.teslamotors.com/api/1/products', [
            'http_errors' => false,
            'headers' => ['Authorization' => 'Bearer ' . $this->token],
        ]);

        return json_decode((string) $response->getBody(), true);
    }
}
