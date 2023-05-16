<?php

declare(strict_types=1);

namespace KirilCvetkov\TeslaApi\Tests;

use KirilCvetkov\TeslaApi\VehicleCommands\UpcomingCalendarEntries;
use KirilCvetkov\TeslaApi\Hydrator\ModelHydrator;
use KirilCvetkov\TeslaApi\Model\BooleanResponse;
use KirilCvetkov\TeslaApi\Tests\TestCase;

final class UpcomingCalendarEntriesTest extends TestCase
{
    public function testHonk()
    {
        $expectedResponse = true;
        $actualResponse = (new UpcomingCalendarEntries($this->getClient(['response' => $expectedResponse]), new ModelHydrator()))
            ->set($this->testVehicleId);

        $this->isInstanceOf(BooleanResponse::class, $actualResponse);
        $this->assertEquals($expectedResponse, $actualResponse->response);
    }
}
