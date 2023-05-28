<?php

namespace KirilCvetkov\TeslaApi\VehicleCommands;

use KirilCvetkov\TeslaApi\Assert;
use KirilCvetkov\TeslaApi\HttpApi;
use KirilCvetkov\TeslaApi\Model\BooleanResponse;

class ValetMode extends HttpApi
{
    /**
     * Sends an Set Valet Mode command to vehicle.
     *
     * @param int $id Vehicle ID
     * @param bool $on On/Off command
     * @param string $password Account password
     *
     * @return string[]
     */
    public function set(int $id, bool $on, string $password)
    {
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');

        $response = $this->httpPost(sprintf(
            '/api/1/vehicles/%d/command/set_valet_mode?on=%s&password=%s',
            $id,
            $on,
            $password,
        ));

        return $this->hydrateResponse($response, BooleanResponse::class);
    }

    /**
     * Sends an Set Valet Mode command to vehicle.
     *
     * @param int $id Vehicle ID
     * @param string $password Account password
     *
     * @return string[]
     */
    public function resetPin(int $id)
    {
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');

        $response = $this->httpPost(sprintf('/api/1/vehicles/%d/command/reset_valet_pin', $id));

        return $this->hydrateResponse($response, BooleanResponse::class);
    }
}
