<?php

namespace KirilCvetkov\TeslaApi\VehicleCommands;

use KirilCvetkov\TeslaApi\Assert;
use KirilCvetkov\TeslaApi\HttpApi;
use KirilCvetkov\TeslaApi\Model\Vehicle;

class ChargeLimit extends HttpApi
{
    /**
     * Sends a Set Charge Limit command to vehicle.
     *
     * @param int $id Vehicle ID
     *
     * @return string[]
     */
    public function set(int $id)
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
     */
    public function setMaxRange(int $id)
    {
        Assert::integer($id);
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');

        $response = $this->httpPost(sprintf('/api/1/vehicles/%d/command/charge_max_range', $id));

        return $this->hydrateResponse($response, Vehicle::class);
    }

    /**
     * Sends a Set Standard Charge Limit command to vehicle.
     *
     * @param int $id Vehicle ID
     *
     * @return string[]
     */
    public function setStandard(int $id)
    {
        Assert::integer($id);
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');

        $response = $this->httpPost(sprintf('/api/1/vehicles/%d/command/charge_standard', $id));

        return $this->hydrateResponse($response, Vehicle::class);
    }
}
