<?php

declare(strict_types=1);

namespace KirilCvetkov\TeslaApi\Tests;

use KirilCvetkov\TeslaApi\VehicleCommands\Door;
use KirilCvetkov\TeslaApi\Hydrator\ModelHydrator;
use KirilCvetkov\TeslaApi\Model\BooleanResponse;
use KirilCvetkov\TeslaApi\Tests\TestCase;

final class DoorTest extends TestCase
{
    private bool $expectedResponse = true;
    private Door $door;

    public function setUp(): void
    {
        $this->door = new Door(
            $this->getClient(['response' => $this->expectedResponse]),
            new ModelHydrator()
        );
    }

    public function testUnlock()
    {
        $actualResponse = $this->door->unlock($this->testVehicleId);

        $this->isInstanceOf(BooleanResponse::class, $actualResponse);
        $this->assertEquals($this->expectedResponse, $actualResponse->response);
    }

    public function testLock()
    {
        $actualResponse = $this->door->lock($this->testVehicleId);

        $this->isInstanceOf(BooleanResponse::class, $actualResponse);
        $this->assertEquals($this->expectedResponse, $actualResponse->response);
    }
}
