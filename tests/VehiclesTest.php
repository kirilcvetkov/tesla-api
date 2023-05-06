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
use KirilCvetkov\TeslaApi\Hydrator\ArrayHydrator;
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

    public function getClient(array $expectedResponse)
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], json_encode($expectedResponse)),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $mockClient = new Client(['handler' => $handlerStack]);

        return (new HttpClient('test'))->setHttpClient($mockClient);
    }

    public function testIndex()
    {
        $expectedResponse = ['response' => [[$this->testVehicle]], 'count' => 1];
        $actualResponse = (new Vehicles($this->getClient($expectedResponse), new ArrayHydrator()))
            ->index();

        $this->assertIsArray($actualResponse);
        $this->assertEquals($expectedResponse, $actualResponse);
    }

    public function testShow()
    {
        $expectedResponse = ['response' => [$this->testVehicle]];
        $actualResponse = (new Vehicles($this->getClient($expectedResponse), new ArrayHydrator()))
            ->show($this->testVehicle['id']);

        $this->assertIsArray($actualResponse);
        $this->assertEquals($expectedResponse, $actualResponse);
    }
}
