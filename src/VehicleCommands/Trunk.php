<?php

namespace KirilCvetkov\TeslaApi\VehicleCommands;

use KirilCvetkov\TeslaApi\Assert;
use KirilCvetkov\TeslaApi\HttpApi;
use KirilCvetkov\TeslaApi\Model\BooleanResponse;

class Trunk extends HttpApi
{
    public const REAR = 'rear';
    public const FRONT = 'front';

    /**
     * Sends an Actuate Trunk command to vehicle.
     *
     * @param int $id Vehicle ID
     *
     * @return string[]
     */
    public function actuate(int $id, string $which = self::REAR)
    {
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');
        Assert::true(in_array($which, [self::REAR, self::FRONT]), 'Which trunk to actuate: rear or front.');

        $response = $this->httpPost(
            sprintf('/api/1/vehicles/%d/command/actuate_trunk?which_trunk=%s', $id, $which)
        );

        return $this->hydrateResponse($response, BooleanResponse::class);
    }
}
