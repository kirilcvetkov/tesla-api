<?php

namespace KirilCvetkov\TeslaApi\VehicleCommands;

use KirilCvetkov\TeslaApi\Assert;
use KirilCvetkov\TeslaApi\HttpApi;
use KirilCvetkov\TeslaApi\Model\Vehicle;

class Temperature extends HttpApi
{
    /**
     * Sends a Set Temperature command to vehicle.
     *
     * @param int $id Vehicle ID
     *
     * @return string[]
     * @throws ClientExceptionInterface
     */
    public function set(int $id, int $driverTemp, int $passengerTemp)
    {
        Assert::integer($id);
        Assert::integer($driverTemp);
        Assert::integer($passengerTemp);
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');
        Assert::greaterThan($driverTemp, 0, 'Vehicle ID must be greater than zero.');
        Assert::greaterThan($passengerTemp, 0, 'Vehicle ID must be greater than zero.');

        $response = $this->httpPost(sprintf(
            'https://owner-api.teslamotors.com/api/1/vehicles/%d/command/set_temps?driver_temp=%d&passenger_temp=%d',
            $id,
            $driverTemp,
            $passengerTemp,
        ));

        return $this->hydrateResponse($response, Vehicle::class);
    }
}
