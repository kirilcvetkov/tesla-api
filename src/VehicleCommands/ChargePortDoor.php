<?php

namespace KirilCvetkov\TeslaApi\VehicleCommands;

use KirilCvetkov\TeslaApi\Assert;
use KirilCvetkov\TeslaApi\HttpApi;
use KirilCvetkov\TeslaApi\Model\Vehicle;

class ChargePortDoor extends HttpApi
{
    /**
     * Sends an Open Charge Port command to vehicle.
     *
     * @param int $id Vehicle ID
     *
     * @return string[]
     * @throws ClientExceptionInterface
     */
    public function open(int $id)
    {
        Assert::integer($id);
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');

        $response = $this->httpPost(sprintf('/api/1/vehicles/%d/command/charge_port_door_open', $id));

        return $this->hydrateResponse($response, Vehicle::class);
    }

    /**
     * Sends an Close Charge Port command to vehicle.
     *
     * @param int $id Vehicle ID
     *
     * @return string[]
     * @throws ClientExceptionInterface
     */
    public function close(int $id)
    {
        Assert::integer($id);
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');

        $response = $this->httpPost(sprintf('/api/1/vehicles/%d/command/charge_port_door_close', $id));

        return $this->hydrateResponse($response, Vehicle::class);
    }
}
