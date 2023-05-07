<?php

declare(strict_types=1);

namespace KirilCvetkov\TeslaApi\Tests;

use KirilCvetkov\TeslaApi\Hydrator\ModelHydrator;
use KirilCvetkov\TeslaApi\Users;
use KirilCvetkov\TeslaApi\Model\BoolResponse;
use KirilCvetkov\TeslaApi\Model\User\MeResponse;
use KirilCvetkov\TeslaApi\Model\User\FeaturesResponse;
use KirilCvetkov\TeslaApi\Model\User\VaultResponse;

final class UsersTest extends TestCase
{
    private $responses = [
        'me' => [
            'email' => 'owner@email.com',
            'full_name' => 'Tesla Owner',
            'profile_image_url' => 'https://vehicle-files.prd.usw2.vn.cloud.tesla.com/profile_images/profile.jpg',
        ],
    ];

    public function testMe()
    {
        $expectedItems = [$this->responses['me']];
        $actualResponse = (new Users($this->getClient(['response' => $expectedItems]), new ModelHydrator()))
            ->me();

        $this->isInstanceOf(MeResponse::class, $actualResponse);
        $this->assertEquals($expectedItems, $actualResponse->items);
    }

    public function testVault()
    {
        $testVaultResponse = 'base64encoded';
        $expectedResponse = ['response' => ['vault' => $testVaultResponse]];
        $actualResponse = (new Users($this->getClient($expectedResponse), new ModelHydrator()))
            ->vault();

        $this->isInstanceOf(VaultResponse::class, $actualResponse);
        $this->assertEquals($testVaultResponse, $actualResponse->vault);
    }

    public function testFeatures()
    {
        $testSignalingEnabled = true;
        $testSubscribeConnectivity = true;
        $expectedResponse = [
            'response' => [
                'signaling' => [
                    'enabled' => $testSignalingEnabled,
                    'subscribe_connectivity' => $testSubscribeConnectivity,
                ]
            ]
        ];

        $actualResponse = (new Users($this->getClient($expectedResponse), new ModelHydrator()))
            ->features();

        $this->isInstanceOf(FeaturesResponse::class, $actualResponse);
        $this->assertEquals($testSignalingEnabled, $actualResponse->signalingEnabled);
        $this->assertEquals($testSubscribeConnectivity, $actualResponse->subscribeConnectivity);
    }

    public function testKeys()
    {
        $expectedResponse = true;
        $actualResponse = (new Users($this->getClient(['response' => $expectedResponse]), new ModelHydrator()))
            ->keys(publicKey: 'test', name: 'test', model: 'test');

        $this->isInstanceOf(BoolResponse::class, $actualResponse);
        $this->assertEquals($expectedResponse, $actualResponse->response);
    }
}
