<?php

namespace KirilCvetkov\TeslaApi\VehicleCommands;

use KirilCvetkov\TeslaApi\Assert;
use KirilCvetkov\TeslaApi\HttpApi;
use KirilCvetkov\TeslaApi\Model\BooleanResponse;

class Lights extends HttpApi
{
    /**
     * Sends a Wake Up command to vehicle.
     *
     * @param int $id Vehicle ID
     *
     * @return string[]
     */
    public function flash(int $id)
    {
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');

        $response = $this->httpPost(sprintf('/api/1/vehicles/%d/flash_lights', $id));

        return $this->hydrateResponse($response, BooleanResponse::class);
    }
}
