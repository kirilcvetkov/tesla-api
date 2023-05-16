<?php

declare(strict_types=1);

namespace KirilCvetkov\TeslaApi\Tests\VehicleCommands;

use KirilCvetkov\TeslaApi\Exception\InvalidArgumentException;
use KirilCvetkov\TeslaApi\Hydrator\ModelHydrator;
use KirilCvetkov\TeslaApi\Model\Vehicle;
use KirilCvetkov\TeslaApi\VehicleCommands\WakeUp;
use KirilCvetkov\TeslaApi\Tests\TestCase;

final class WakeupTest extends TestCase
{
    private $testVehicle = [
        'id' => 12345678901234567,
        'user_id' => 12345,
        'vehicle_id' => 1234567890,
        'vin' => '5YJSA11111111111',
        'display_name' => 'Nikola 2.0',
        'color' => null,
        'tokens' => ['abcdef1234567890', '1234567890abcdef'],
        'state' => 'online',
        'in_service' => false,
        'id_s' => '12345678901234567',
        'calendar_enabled' => true,
        'api_version' => 7,
        'backseat_token' => null,
        'backseat_token_updated_at' => null,
    ];

    public function testSend()
    {
        $expectedResponse = ['response' => $this->testVehicle];
        $actualResponse = (new WakeUp($this->getClient($expectedResponse), new ModelHydrator()))
            ->send($this->testVehicle['vehicle_id']);

        $this->isInstanceOf(Vehicle::class, $actualResponse);
        $this->assertEquals($expectedResponse['response']['id'], $actualResponse->id);
        $this->assertEquals($expectedResponse['response']['user_id'], $actualResponse->userId);
        $this->assertEquals($expectedResponse['response']['vehicle_id'], $actualResponse->vehicleId);
        $this->assertEquals($expectedResponse['response']['vin'], $actualResponse->vin);
        $this->assertEquals($expectedResponse['response']['display_name'], $actualResponse->displayName);
        $this->assertEquals($expectedResponse['response']['color'], $actualResponse->color);
        $this->assertEquals($expectedResponse['response']['tokens'], $actualResponse->tokens);
        $this->assertEquals($expectedResponse['response']['state'], $actualResponse->state);
        $this->assertEquals($expectedResponse['response']['in_service'], $actualResponse->inService);
        $this->assertEquals($expectedResponse['response']['id_s'], $actualResponse->idS);
        $this->assertEquals($expectedResponse['response']['calendar_enabled'], $actualResponse->calendarEnabled);
        $this->assertEquals($expectedResponse['response']['api_version'], $actualResponse->apiVersion);
        $this->assertEquals($expectedResponse['response']['backseat_token'], $actualResponse->backseatToken);
        $this->assertEquals($expectedResponse['response']['backseat_token_updated_at'], $actualResponse->backseatTokenUpdatedAt);
    }

    public function testSendInvalidVehicleId()
    {
        $invalidVehicleId = 0;

        $this->expectException(InvalidArgumentException::class);

        $actualResponse = (new WakeUp($this->getClient(['response' => $this->testVehicle]), new ModelHydrator()))
            ->send($invalidVehicleId);
    }
}
