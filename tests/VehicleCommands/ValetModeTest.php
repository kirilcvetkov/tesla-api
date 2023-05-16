<?php

declare(strict_types=1);

namespace KirilCvetkov\TeslaApi\Tests;

use KirilCvetkov\TeslaApi\VehicleCommands\ValetMode;
use KirilCvetkov\TeslaApi\Hydrator\ModelHydrator;
use KirilCvetkov\TeslaApi\Model\BooleanResponse;
use KirilCvetkov\TeslaApi\Tests\TestCase;

final class ValetModeTest extends TestCase
{
    private bool $expectedResponse = true;
    private ValetMode $valetMode;

    public function setUp(): void
    {
        $this->valetMode = new ValetMode(
            $this->getClient(['response' => $this->expectedResponse]),
            new ModelHydrator()
        );
    }

    public function testSet()
    {
        $on = 'test';
        $password = 'pass';
        $actualResponse = $this->valetMode->set($this->testVehicleId, $on, $password);

        $this->isInstanceOf(BooleanResponse::class, $actualResponse);
        $this->assertEquals($this->expectedResponse, $actualResponse->response);
    }

    public function testResetPin()
    {
        $actualResponse = $this->valetMode->resetPin($this->testVehicleId);

        $this->isInstanceOf(BooleanResponse::class, $actualResponse);
        $this->assertEquals($this->expectedResponse, $actualResponse->response);
    }
}
