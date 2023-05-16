<?php

declare(strict_types=1);

namespace KirilCvetkov\TeslaApi\Tests;

use KirilCvetkov\TeslaApi\VehicleCommands\Charge;
use KirilCvetkov\TeslaApi\Hydrator\ModelHydrator;
use KirilCvetkov\TeslaApi\Model\BooleanResponse;
use KirilCvetkov\TeslaApi\Tests\TestCase;

final class ChargeTest extends TestCase
{
    private bool $expectedResponse = true;
    private Charge $charge;

    public function setUp(): void
    {
        $this->charge = new Charge(
            $this->getClient(['response' => $this->expectedResponse]),
            new ModelHydrator()
        );
    }

    public function testStart()
    {
        $actualResponse = $this->charge->start($this->testVehicleId);

        $this->isInstanceOf(BooleanResponse::class, $actualResponse);
        $this->assertEquals($this->expectedResponse, $actualResponse->response);
    }

    public function testStop()
    {
        $actualResponse = $this->charge->stop($this->testVehicleId);

        $this->isInstanceOf(BooleanResponse::class, $actualResponse);
        $this->assertEquals($this->expectedResponse, $actualResponse->response);
    }
}
