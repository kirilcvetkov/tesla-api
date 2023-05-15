<?php

namespace KirilCvetkov\TeslaApi\VehicleCommands;

use KirilCvetkov\TeslaApi\Assert;
use KirilCvetkov\TeslaApi\HttpApi;
use KirilCvetkov\TeslaApi\Model\Vehicle;

class Charge extends HttpApi
{
    /**
     * Sends a Set Charge Limit command to vehicle.
     *
     * @param int $id Vehicle ID
     *
     * @return string[]
     * @throws ClientExceptionInterface
     */
    public function setLimit(int $id)
    {
        Assert::integer($id);
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');

        $response = $this->httpPost(sprintf('/api/1/vehicles/%d/command/set_charge_limit?percent=:limit_value', $id));

        return $this->hydrateResponse($response, Vehicle::class);
    }

    /**
     * Sends a Set Max Range Charge Limit command to vehicle.
     *
     * @param int $id Vehicle ID
     *
     * @return string[]
     * @throws ClientExceptionInterface
     */
    public function setMaxRange(int $id)
    {
        Assert::integer($id);
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');

        $response = $this->httpPost(sprintf('/api/1/vehicles/%d/command/charge_max_range', $id));

        return $this->hydrateResponse($response, Vehicle::class);
    }

    /**
     * Sends an Open Charge Port command to vehicle.
     *
     * @param int $id Vehicle ID
     *
     * @return string[]
     * @throws ClientExceptionInterface
     */
    public function chargePortDoorOpen(int $id)
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
    public function chargePortDoorClose(int $id)
    {
        Assert::integer($id);
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');

        $response = $this->httpPost(sprintf('/api/1/vehicles/%d/command/charge_port_door_close', $id));

        return $this->hydrateResponse($response, Vehicle::class);
    }

    /**
     * Sends an Charge Start command to vehicle.
     *
     * @param int $id Vehicle ID
     *
     * @return string[]
     * @throws ClientExceptionInterface
     */
    public function chargeStart(int $id)
    {
        Assert::integer($id);
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');

        $response = $this->httpPost(sprintf('/api/1/vehicles/%d/command/charge_start', $id));

        return $this->hydrateResponse($response, Vehicle::class);
    }

    /**
     * Sends an Charge Stop command to vehicle.
     *
     * @param int $id Vehicle ID
     *
     * @return string[]
     * @throws ClientExceptionInterface
     */
    public function chargeStop(int $id)
    {
        Assert::integer($id);
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');

        $response = $this->httpPost(sprintf('/api/1/vehicles/%d/command/charge_stop', $id));

        return $this->hydrateResponse($response, Vehicle::class);
    }
}
