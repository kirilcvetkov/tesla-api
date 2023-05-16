<?php

declare(strict_types=1);

namespace KirilCvetkov\TeslaApi\Tests;

use KirilCvetkov\TeslaApi\VehicleCommands\Horn;
use KirilCvetkov\TeslaApi\Hydrator\ModelHydrator;
use KirilCvetkov\TeslaApi\Model\BooleanResponse;
use KirilCvetkov\TeslaApi\Tests\TestCase;

final class HornTest extends TestCase
{
    public function testHonk()
    {
        $expectedResponse = true;
        $actualResponse = (new Horn($this->getClient(['response' => $expectedResponse]), new ModelHydrator()))
            ->honk($this->testVehicleId);

        $this->isInstanceOf(BooleanResponse::class, $actualResponse);
        $this->assertEquals($expectedResponse, $actualResponse->response);
    }
}
