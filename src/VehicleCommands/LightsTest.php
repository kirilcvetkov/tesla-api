<?php

declare(strict_types=1);

namespace KirilCvetkov\TeslaApi\Tests;

use KirilCvetkov\TeslaApi\VehicleCommands\Lights;
use KirilCvetkov\TeslaApi\Hydrator\ModelHydrator;
use KirilCvetkov\TeslaApi\Model\BooleanResponse;
use KirilCvetkov\TeslaApi\Tests\TestCase;

final class LightsTest extends TestCase
{
    public function testHonk()
    {
        $testVehicleId = 1;
        $expectedResponse = true;
        $actualResponse = (new Lights($this->getClient(['response' => $expectedResponse]), new ModelHydrator()))
            ->flash($testVehicleId);

        $this->isInstanceOf(BooleanResponse::class, $actualResponse);
        $this->assertEquals($expectedResponse, $actualResponse->response);
    }
}
