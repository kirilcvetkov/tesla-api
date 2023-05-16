<?php

namespace KirilCvetkov\TeslaApi\VehicleCommands;

use KirilCvetkov\TeslaApi\Assert;
use KirilCvetkov\TeslaApi\HttpApi;
use KirilCvetkov\TeslaApi\Model\BooleanResponse;

class SpeedLimit extends HttpApi
{
    /**
     * Sends a Speed Limit Set Limit command to vehicle.
     *
     * @param int $id Vehicle ID
     *
     * @return string[]
     */
    public function set(int $id)
    {
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');

        $response = $this->httpPost(sprintf('/api/1/vehicles/%d/speed_limit_set_limit', $id));

        return $this->hydrateResponse($response, BooleanResponse::class);
    }

    /**
     * Sends a Speed Limit Clear PIN command to vehicle.
     *
     * @param int $id Vehicle ID
     *
     * @return string[]
     */
    public function clearPin(int $id)
    {
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');

        $response = $this->httpPost(sprintf('/api/1/vehicles/%d/speed_limit_clear_pin', $id));

        return $this->hydrateResponse($response, BooleanResponse::class);
    }

    /**
     * Sends a Speed Limit Activate command to vehicle.
     *
     * @param int $id Vehicle ID
     *
     * @return string[]
     */
    public function activate(int $id)
    {
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');

        $response = $this->httpPost(sprintf('/api/1/vehicles/%d/speed_limit_activate', $id));

        return $this->hydrateResponse($response, BooleanResponse::class);
    }

    /**
     * Sends a Speed Limit Deactivate command to vehicle.
     *
     * @param int $id Vehicle ID
     *
     * @return string[]
     */
    public function deactivate(int $id)
    {
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');

        $response = $this->httpPost(sprintf('/api/1/vehicles/%d/speed_limit_deactivate', $id));

        return $this->hydrateResponse($response, BooleanResponse::class);
    }
}
