<?php

declare(strict_types=1);

namespace KirilCvetkov\TeslaApi\Tests;

use KirilCvetkov\TeslaApi\VehicleCommands\Homelink;
use KirilCvetkov\TeslaApi\Hydrator\ModelHydrator;
use KirilCvetkov\TeslaApi\Model\BooleanResponse;
use KirilCvetkov\TeslaApi\Tests\TestCase;

final class HomelinkTest extends TestCase
{
    public function testHonk()
    {
        $expectedResponse = true;
        $actualResponse = (new Homelink($this->getClient(['response' => $expectedResponse]), new ModelHydrator()))
            ->trigger($this->testVehicleId);

        $this->isInstanceOf(BooleanResponse::class, $actualResponse);
        $this->assertEquals($expectedResponse, $actualResponse->response);
    }
}
