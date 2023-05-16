<?php

namespace KirilCvetkov\TeslaApi\VehicleCommands;

use KirilCvetkov\TeslaApi\Assert;
use KirilCvetkov\TeslaApi\HttpApi;
use KirilCvetkov\TeslaApi\Model\BooleanResponse;

class Trunk extends HttpApi
{
    /**
     * Sends an Actuate Trunk command to vehicle.
     *
     * @param int $id Vehicle ID
     *
     * @return string[]
     */
    public function actuate(int $id)
    {
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');

        $response = $this->httpPost(sprintf('/api/1/vehicles/%d/command/actuate_trunk', $id));

        return $this->hydrateResponse($response, BooleanResponse::class);
    }
}
