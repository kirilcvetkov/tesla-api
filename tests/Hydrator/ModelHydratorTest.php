<?php

declare(strict_types=1);

namespace Tests\Hydrator;

use GuzzleHttp\Psr7\Response;
use KirilCvetkov\TeslaApi\Exception\HydrationException;
use KirilCvetkov\TeslaApi\Hydrator\ModelHydrator;
use KirilCvetkov\TeslaApi\Model\User\Me;
use PHPUnit\Framework\TestCase;

final class ModelHydratorTest extends TestCase
{
    private $email = 'owner@email.com';
    private $fullName = 'Tesla Owner';
    private $profileImageUrl = 'https://vehicle-files.prd.usw2.vn.cloud.tesla.com/profile_images/profile.jpg';
    private array $validContentType = ['Content-Type' => 'application/json'];
    private array $invalidContentType = ['Content-Type' => 'test/invalid'];
    private string $validJsonResponse;
    private string $invalidJsonResponse;

    public function setUp(): void
    {
        $this->validJsonResponse = json_encode([
            'response' => [
                'email' => $this->email,
                'full_name' => $this->fullName,
                'profile_image_url' => $this->profileImageUrl,
            ]
        ]);
        $this->invalidJsonResponse = substr($this->validJsonResponse, 0, -1);
    }

    public function testHydrate()
    {
        $response = new Response(200, $this->validContentType, $this->validJsonResponse);

        $hydratedResponse = (new ModelHydrator())->hydrate($response, Me::class);

        $this->assertInstanceOf(Me::class, $hydratedResponse);
        $this->assertEquals($this->email, $hydratedResponse->email);
        $this->assertEquals($this->fullName, $hydratedResponse->fullName);
        $this->assertEquals($this->profileImageUrl, $hydratedResponse->profileImageUrl);
    }

    public function testHydrationExceptionContentType()
    {
        $response = new Response(200, $this->invalidContentType, $this->validJsonResponse);

        $this->expectException(HydrationException::class);

        $hydratedResponse = (new ModelHydrator())->hydrate($response, Me::class);
    }

    public function testHydrationExceptionJsonError()
    {
        $response = new Response(200, $this->validContentType, $this->invalidJsonResponse);

        $this->expectException(HydrationException::class);

        $hydratedResponse = (new ModelHydrator())->hydrate($response, Me::class);
    }
}
