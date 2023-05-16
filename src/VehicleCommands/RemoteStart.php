<?php

namespace KirilCvetkov\TeslaApi\VehicleCommands;

use KirilCvetkov\TeslaApi\Assert;
use KirilCvetkov\TeslaApi\HttpApi;
use KirilCvetkov\TeslaApi\Model\BooleanResponse;

class RemoteStart extends HttpApi
{
    /**
     * Sends an Remote Start Drive command to vehicle.
     *
     * @param int $id Vehicle ID
     * @param string $password Account password
     *
     * @return string[]
     */
    public function drive(int $id, string $password)
    {
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');

        $response = $this->httpPost(sprintf(
            '/api/1/vehicles/%d/command/remote_start_drive?password=%s',
            $id,
            $password,
        ));

        return $this->hydrateResponse($response, BooleanResponse::class);
    }
}
