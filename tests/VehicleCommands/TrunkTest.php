<?php

declare(strict_types=1);

namespace KirilCvetkov\TeslaApi\Tests;

use KirilCvetkov\TeslaApi\VehicleCommands\Trunk;
use KirilCvetkov\TeslaApi\Hydrator\ModelHydrator;
use KirilCvetkov\TeslaApi\Model\BooleanResponse;
use KirilCvetkov\TeslaApi\Tests\TestCase;

final class TrunkTest extends TestCase
{
    public function testHonk()
    {
        $expectedResponse = true;
        $actualResponse = (new Trunk($this->getClient(['response' => $expectedResponse]), new ModelHydrator()))
            ->actuate($this->testVehicleId, Trunk::REAR);

        $this->isInstanceOf(BooleanResponse::class, $actualResponse);
        $this->assertEquals($expectedResponse, $actualResponse->response);
    }
}
