<?php

namespace KirilCvetkov\TeslaApi\VehicleCommands;

use KirilCvetkov\TeslaApi\Assert;
use KirilCvetkov\TeslaApi\HttpApi;
use KirilCvetkov\TeslaApi\Model\BooleanResponse;

class UpcomingCalendarEntries extends HttpApi
{
    /**
     * Sends a Upcoming Calendar Entries command to vehicle.
     *
     * @param int $id Vehicle ID
     *
     * @return string[]
     */
    public function set(int $id)
    {
        Assert::greaterThan($id, 0, 'Vehicle ID must be greater than zero.');

        $response = $this->httpPost(sprintf('/api/1/vehicles/%d/upcoming_calendar_entries', $id));

        return $this->hydrateResponse($response, BooleanResponse::class);
    }
}
