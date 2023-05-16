<?php

namespace KirilCvetkov\TeslaApi;

use KirilCvetkov\TeslaApi\Model\IndexResponse;
use KirilCvetkov\TeslaApi\Model\Vehicle;

class Vehicles extends HttpApi
{
    /**
     * Returns a list of domains on the account.
     *
     * @return array[]
     */
    public function index()
    {
        $response = $this->httpGet('/api/1/vehicles');

        return $this->hydrateResponse($response, IndexResponse::class);
    }

    /**
     * Returns a single vehicle.
     *
     * @param int $id Vehicle ID
     *
     * @return string[]
     */
    public function show(int $id)
    {
        Assert::integer($id);
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');

        $response = $this->httpGet(sprintf('/api/1/vehicles/%d', $id));

        return $this->hydrateResponse($response, Vehicle::class);
    }
}
