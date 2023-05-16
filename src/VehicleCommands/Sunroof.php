<?php

namespace KirilCvetkov\TeslaApi\VehicleCommands;

use KirilCvetkov\TeslaApi\Assert;
use KirilCvetkov\TeslaApi\HttpApi;
use KirilCvetkov\TeslaApi\Model\Vehicle;

class Sunroof extends HttpApi
{
    /**
     * Sends a Set Sunroof Position command to vehicle.
     *
     * @param int $id Vehicle ID
     * @param ?string $state Sunroof state: open - 100% | closed - 0% | comfort - 80% | vent - 15% | move - specify percent
     * @param ?int $percent Vehicle ID
     *
     * @return string[]
     */
    public function set(int $id, string $state, ?int $percent = null)
    {
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');
        Assert::regex($state, '/open|closed|comfort|vent|move/', 'State allows only open, closed, comfort, or vent.');

        $percent = match ($state) {
            'open' => 100,
            'closed' => 0,
            'comfort' => 80,
            'vent' => 15,
            'move' => $percent ?? 0,
        };

        $response = $this->httpPost(sprintf(
            'https://owner-api.teslamotors.com/api/1/vehicles/%d/command/sun_roof_control?state=%s&percent=%d',
            $id,
            $state,
            $percent,
        ));

        return $this->hydrateResponse($response, Vehicle::class);
    }
}
