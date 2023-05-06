<?php

declare(strict_types=1);

namespace KirilCvetkov\TeslaApi\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;
use KirilCvetkov\TeslaApi\Products;
use KirilCvetkov\TeslaApi\HttpClient;
use KirilCvetkov\TeslaApi\Hydrator\ArrayHydrator;

final class ProductsTest extends TestCase
{
    private $testResponse = [
        'response' => [
            [
                'energy_site_id' => 2252147638651575,
                'resource_type' => 'solar',
                'id' => '313dbc37-555c-45b1-83aa-62a4ef9ff7ac',
                'asset_site_id' => '47d04752-9cf1-4e76-88fb-08839a1c41c4',
                'solar_power' => 2320,
                'solar_type' => 'pv_panel',
                'sync_grid_alert_enabled' => false,
                'breaker_alert_enabled' => false,
                'components' => [
                    'battery' => false,
                    'solar' => true,
                    'solar_type' => 'pv_panel',
                    'grid' => true,
                    'load_meter' => false,
                    'market_type' => 'residential',
                ],
            ],
        ],
        'count' => 1,
    ];

    public function testIndex()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], json_encode($this->testResponse)),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $mockClient = new Client(['handler' => $handlerStack]);

        $httpClient = (new HttpClient('test'))->setHttpClient($mockClient);
        $hydrator = new ArrayHydrator();
        $products = new Products($httpClient, $hydrator);

        $this->assertEquals($this->testResponse, $products->index());
    }
}
