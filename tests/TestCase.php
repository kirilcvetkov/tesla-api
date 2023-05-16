<?php

namespace KirilCvetkov\TeslaApi\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use KirilCvetkov\TeslaApi\HttpClient;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public int $testVehicleId = 1;

    public function getClient(array $expectedResponse)
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], json_encode($expectedResponse)),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $mockClient = new Client(['handler' => $handlerStack]);

        return (new HttpClient('test'))->set($mockClient);
    }
}
