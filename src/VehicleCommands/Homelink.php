<?php

namespace KirilCvetkov\TeslaApi\VehicleCommands;

use KirilCvetkov\TeslaApi\Assert;
use KirilCvetkov\TeslaApi\HttpApi;
use KirilCvetkov\TeslaApi\Model\BooleanResponse;

class Homelink extends HttpApi
{
    /**
     * Sends a Honk Horn command to vehicle.
     *
     * @param int $id Vehicle ID
     *
     * @return string[]
     */
    public function trigger(int $id)
    {
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');

        $response = $this->httpPost(sprintf('/api/1/vehicles/%d/command/trigger_homelink', $id));

        return $this->hydrateResponse($response, BooleanResponse::class);
    }
}
