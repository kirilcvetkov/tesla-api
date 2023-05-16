<?php

declare(strict_types=1);

namespace KirilCvetkov\TeslaApi\Tests;

use KirilCvetkov\TeslaApi\VehicleCommands\AutoConditioning;
use KirilCvetkov\TeslaApi\Hydrator\ModelHydrator;
use KirilCvetkov\TeslaApi\Model\BooleanResponse;
use KirilCvetkov\TeslaApi\Tests\TestCase;

final class AutoConditioningTest extends TestCase
{
    private bool $expectedResponse = true;
    private AutoConditioning $autoConditioning;

    public function setUp(): void
    {
        $this->autoConditioning = new AutoConditioning(
            $this->getClient(['response' => $this->expectedResponse]),
            new ModelHydrator()
        );
    }

    public function testStart()
    {
        $actualResponse = $this->autoConditioning->start($this->testVehicleId);

        $this->isInstanceOf(BooleanResponse::class, $actualResponse);
        $this->assertEquals($this->expectedResponse, $actualResponse->response);
    }

    public function testStop()
    {
        $actualResponse = $this->autoConditioning->stop($this->testVehicleId);

        $this->isInstanceOf(BooleanResponse::class, $actualResponse);
        $this->assertEquals($this->expectedResponse, $actualResponse->response);
    }

    public function testSetTemperature()
    {
        $driverTemp = 22;
        $passengerTemp = 22;
        $actualResponse = $this->autoConditioning->setTemperature($this->testVehicleId, $driverTemp, $passengerTemp);

        $this->isInstanceOf(BooleanResponse::class, $actualResponse);
        $this->assertEquals($this->expectedResponse, $actualResponse->response);
    }
}
