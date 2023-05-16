<?php

namespace KirilCvetkov\TeslaApi\VehicleCommands;

use KirilCvetkov\TeslaApi\Assert;
use KirilCvetkov\TeslaApi\HttpApi;
use KirilCvetkov\TeslaApi\Model\Vehicle;

class Wakeup extends HttpApi
{
    /**
     * Sends a Wake Up command to vehicle.
     *
     * @param int $id Vehicle ID
     *
     * @return string[]
     */
    public function send(int $id)
    {
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');

        $response = $this->httpPost(sprintf('/api/1/vehicles/%d/wake_up', $id));

        return $this->hydrateResponse($response, Vehicle::class);
    }
}
