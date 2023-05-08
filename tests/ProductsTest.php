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
    private $testProduct = [
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
        ]
    ];

    public function testIndex()
    {
        $expectedResponse = ['response' => [[$this->testProduct]], 'count' => 1];
        $actualResponse = (new Products($this->getClient($expectedResponse), new ArrayHydrator()))
            ->index();

        $this->assertIsArray($actualResponse);
        $this->assertEquals($expectedResponse, $actualResponse);
    }
}
