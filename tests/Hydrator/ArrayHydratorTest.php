<?php

declare(strict_types=1);

namespace Tests\Hydrator;

use GuzzleHttp\Psr7\Response;
use KirilCvetkov\TeslaApi\Hydrator\ArrayHydrator;
use KirilCvetkov\TeslaApi\Exception\HydrationException;
use PHPUnit\Framework\TestCase;

final class ArrayHydratorTest extends TestCase
{
    private array $testResponse = ['test' => 123];
    private array $validContentType = ['Content-Type' => 'application/json'];
    private array $invalidContentType = ['Content-Type' => 'test/invalid'];
    private string $validJsonResponse;
    private string $invalidJsonResponse;

    public function setUp(): void
    {
        $this->validJsonResponse = json_encode($this->testResponse);
        $this->invalidJsonResponse = substr($this->validJsonResponse, 0, -1);
    }

    public function testHydrate()
    {
        $response = new Response(200, $this->validContentType, $this->validJsonResponse);

        $hydratedResponse = (new ArrayHydrator())->hydrate($response, '');

        $this->assertIsArray($hydratedResponse);
        $this->assertEquals($this->testResponse, $hydratedResponse);
    }

    public function testHydrationExceptionContentType()
    {
        $response = new Response(200, $this->invalidContentType, $this->validJsonResponse);

        $this->expectException(HydrationException::class);

        $hydratedResponse = (new ArrayHydrator())->hydrate($response, '');
    }

    public function testHydrationExceptionJsonError()
    {
        $response = new Response(200, $this->validContentType, $this->invalidJsonResponse);

        $this->expectException(HydrationException::class);

        $hydratedResponse = (new ArrayHydrator())->hydrate($response, '');
    }
}
