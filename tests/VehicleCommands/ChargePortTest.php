<?php

declare(strict_types=1);

namespace KirilCvetkov\TeslaApi\Tests;

use KirilCvetkov\TeslaApi\VehicleCommands\ChargePort;
use KirilCvetkov\TeslaApi\Hydrator\ModelHydrator;
use KirilCvetkov\TeslaApi\Model\BooleanResponse;
use KirilCvetkov\TeslaApi\Tests\TestCase;

final class ChargePortTest extends TestCase
{
    private bool $expectedResponse = true;
    private ChargePort $chargePort;

    public function setUp(): void
    {
        $this->chargePort = new ChargePort(
            $this->getClient(['response' => $this->expectedResponse]),
            new ModelHydrator()
        );
    }

    public function testOpen()
    {
        $actualResponse = $this->chargePort->open($this->testVehicleId);

        $this->isInstanceOf(BooleanResponse::class, $actualResponse);
        $this->assertEquals($this->expectedResponse, $actualResponse->response);
    }

    public function testClose()
    {
        $actualResponse = $this->chargePort->close($this->testVehicleId);

        $this->isInstanceOf(BooleanResponse::class, $actualResponse);
        $this->assertEquals($this->expectedResponse, $actualResponse->response);
    }
}
