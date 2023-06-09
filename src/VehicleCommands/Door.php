<?php

namespace KirilCvetkov\TeslaApi\VehicleCommands;

use KirilCvetkov\TeslaApi\Assert;
use KirilCvetkov\TeslaApi\HttpApi;
use KirilCvetkov\TeslaApi\Model\BooleanResponse;

class Door extends HttpApi
{
    /**
     * Sends a Door Unlock command to vehicle.
     *
     * @param int $id Vehicle ID
     *
     * @return string[]
     */
    public function unlock(int $id)
    {
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');

        $response = $this->httpPost(sprintf('/api/1/vehicles/%d/command/door_unlock', $id));

        return $this->hydrateResponse($response, BooleanResponse::class);
    }

    /**
     * Sends a Door Unlock command to vehicle.
     *
     * @param int $id Vehicle ID
     *
     * @return string[]
     */
    public function lock(int $id)
    {
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');

        $response = $this->httpPost(sprintf('/api/1/vehicles/%d/command/door_lock', $id));

        return $this->hydrateResponse($response, BooleanResponse::class);
    }
}
