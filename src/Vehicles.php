<?php

namespace KirilCvetkov\TeslaApi;

use GuzzleHttp\Client;

class Vehicles extends HttpApi
{
    /**
     * Returns a list of domains on the account.
     *
     * @return array[]
     * @throws ClientExceptionInterface
     */
    public function index()
    {
        $response = $this->httpGet('/api/1/vehicles');

        return $this->hydrateResponse($response);
    }

    /**
     * Returns a single vehicle.
     *
     * @param int $id Vehicle ID
     *
     * @return string[]
     * @throws ClientExceptionInterface
     */
    public function show(int $id)
    {
        Assert::integer($id);
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');

        $response = $this->httpGet(sprintf('/api/1/vehicles/%d', $id));

        return $this->hydrateResponse($response);
    }
}
