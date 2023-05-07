<?php

namespace KirilCvetkov\TeslaApi;

use GuzzleHttp\Client;

class Products extends HttpApi
{
    /**
     * Returns a list of domains on the account.
     *
     * @return array
     * @throws ClientExceptionInterface
     */
    public function index()
    {
        $response = $this->httpGet('/api/1/products');

        return $this->hydrateResponse($response, '');
    }
}
