<?php

declare(strict_types=1);

namespace KirilCvetkov\TeslaApi\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;
use KirilCvetkov\TeslaApi\HttpClient;
use KirilCvetkov\TeslaApi\Hydrator\ModelHydrator;
use KirilCvetkov\TeslaApi\Model\IndexResponse;
use KirilCvetkov\TeslaApi\Model\Vehicle;
use KirilCvetkov\TeslaApi\Vehicles;

final class VehiclesTest extends TestCase
{
    private $testVehicle = [
        'id' => 12345678901234567,
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

    public function testIndex()
    {
        $expectedResponse = ['response' => [$this->testVehicle], 'count' => 1];
        $actualResponse = (new Vehicles($this->getClient($expectedResponse), new ModelHydrator()))
            ->index();

        $this->isInstanceOf(IndexResponse::class, $actualResponse);
        $this->assertEquals($expectedResponse['response'], $actualResponse->items);
        $this->assertEquals($expectedResponse['count'], $actualResponse->totalCount);
    }

    public function testShow()
    {
        $expectedResponse = ['response' => $this->testVehicle];
        $actualResponse = (new Vehicles($this->getClient($expectedResponse), new ModelHydrator()))
            ->show($this->testVehicle['id']);

        $this->isInstanceOf(Vehicle::class, $actualResponse);
        $this->assertEquals($expectedResponse['response']['id'], $actualResponse->id);
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
}
