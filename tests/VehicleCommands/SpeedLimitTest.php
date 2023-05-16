<?php

declare(strict_types=1);

namespace KirilCvetkov\TeslaApi\Tests;

use KirilCvetkov\TeslaApi\VehicleCommands\SpeedLimit;
use KirilCvetkov\TeslaApi\Hydrator\ModelHydrator;
use KirilCvetkov\TeslaApi\Model\BooleanResponse;
use KirilCvetkov\TeslaApi\Tests\TestCase;

final class SpeedLimitTest extends TestCase
{
    private bool $expectedResponse = true;
    private SpeedLimit $speedLimit;

    public function setUp(): void
    {
        $this->speedLimit = new SpeedLimit(
            $this->getClient(['response' => $this->expectedResponse]),
            new ModelHydrator()
        );
    }

    public function testSet()
    {
        $actualResponse = $this->speedLimit->set($this->testVehicleId);

        $this->isInstanceOf(BooleanResponse::class, $actualResponse);
        $this->assertEquals($this->expectedResponse, $actualResponse->response);
    }

    public function testClearPin()
    {
        $actualResponse = $this->speedLimit->clearPin($this->testVehicleId);

        $this->isInstanceOf(BooleanResponse::class, $actualResponse);
        $this->assertEquals($this->expectedResponse, $actualResponse->response);
    }

    public function testActivate()
    {
        $actualResponse = $this->speedLimit->activate($this->testVehicleId);

        $this->isInstanceOf(BooleanResponse::class, $actualResponse);
        $this->assertEquals($this->expectedResponse, $actualResponse->response);
    }

    public function testDeactivate()
    {
        $actualResponse = $this->speedLimit->deactivate($this->testVehicleId);

        $this->isInstanceOf(BooleanResponse::class, $actualResponse);
        $this->assertEquals($this->expectedResponse, $actualResponse->response);
    }
}
