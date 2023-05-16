<?php

namespace KirilCvetkov\TeslaApi;

use KirilCvetkov\TeslaApi\Model\IndexResponse;

class Products extends HttpApi
{
    /**
     * Returns a list of domains on the account.
     *
     * @return array
     */
    public function index()
    {
        $response = $this->httpGet('/api/1/products');

        return $this->hydrateResponse($response, IndexResponse::class);
    }
}
