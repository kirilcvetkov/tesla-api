<?php

declare(strict_types=1);

namespace KirilCvetkov\TeslaApi\Tests;

use KirilCvetkov\TeslaApi\VehicleCommands\RemoteStart;
use KirilCvetkov\TeslaApi\Hydrator\ModelHydrator;
use KirilCvetkov\TeslaApi\Model\BooleanResponse;
use KirilCvetkov\TeslaApi\Tests\TestCase;

final class RemoteStartTest extends TestCase
{
    public function testHonk()
    {
        $testPassword = 'pass';
        $expectedResponse = true;
        $actualResponse = (new RemoteStart($this->getClient(['response' => $expectedResponse]), new ModelHydrator()))
            ->drive($this->testVehicleId, $testPassword);

        $this->isInstanceOf(BooleanResponse::class, $actualResponse);
        $this->assertEquals($expectedResponse, $actualResponse->response);
    }
}
