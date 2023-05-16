<?php

namespace KirilCvetkov\TeslaApi\VehicleCommands;

use KirilCvetkov\TeslaApi\Assert;
use KirilCvetkov\TeslaApi\HttpApi;
use KirilCvetkov\TeslaApi\Model\BooleanResponse;

class Charge extends HttpApi
{
    /**
     * Sends an Charge Start command to vehicle.
     *
     * @param int $id Vehicle ID
     *
     * @return string[]
     */
    public function start(int $id)
    {
        Assert::integer($id);
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');

        $response = $this->httpPost(sprintf('/api/1/vehicles/%d/command/charge_start', $id));

        return $this->hydrateResponse($response, BooleanResponse::class);
    }

    /**
     * Sends an Charge Stop command to vehicle.
     *
     * @param int $id Vehicle ID
     *
     * @return string[]
     */
    public function stop(int $id)
    {
        Assert::integer($id);
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');

        $response = $this->httpPost(sprintf('/api/1/vehicles/%d/command/charge_stop', $id));

        return $this->hydrateResponse($response, BooleanResponse::class);
    }
}
