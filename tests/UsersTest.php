<?php

declare(strict_types=1);

namespace KirilCvetkov\TeslaApi\Tests;

use KirilCvetkov\TeslaApi\Hydrator\ModelHydrator;
use KirilCvetkov\TeslaApi\Users;
use KirilCvetkov\TeslaApi\Model\BooleanResponse;
use KirilCvetkov\TeslaApi\Model\User\Me;
use KirilCvetkov\TeslaApi\Model\User\Features;
use KirilCvetkov\TeslaApi\Model\User\Vault;

final class UsersTest extends TestCase
{
    public function testMe()
    {
        $email = 'owner@email.com';
        $fullName = 'Tesla Owner';
        $profileImageUrl = 'https://vehicle-files.prd.usw2.vn.cloud.tesla.com/profile_images/profile.jpg';
        $expectedResponse = [
            'response' => [
                'email' => $email,
                'full_name' => $fullName,
                'profile_image_url' => $profileImageUrl,
            ]
        ];

        $actualResponse = (new Users($this->getClient($expectedResponse), new ModelHydrator()))
            ->me();

        $this->isInstanceOf(Me::class, $actualResponse);
        $this->assertEquals($email, $actualResponse->email);
        $this->assertEquals($fullName, $actualResponse->fullName);
        $this->assertEquals($profileImageUrl, $actualResponse->profileImageUrl);
    }

    public function testVault()
    {
        $testVault = 'base64encoded';
        $expectedResponse = ['response' => ['vault' => $testVault]];
        $actualResponse = (new Users($this->getClient($expectedResponse), new ModelHydrator()))
            ->vault();

        $this->isInstanceOf(Vault::class, $actualResponse);
        $this->assertEquals($testVault, $actualResponse->vault);
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

        $this->isInstanceOf(Features::class, $actualResponse);
        $this->assertEquals($testSignalingEnabled, $actualResponse->signalingEnabled);
        $this->assertEquals($testSubscribeConnectivity, $actualResponse->subscribeConnectivity);
    }

    public function testKeys()
    {
        $expectedResponse = true;
        $actualResponse = (new Users($this->getClient(['response' => $expectedResponse]), new ModelHydrator()))
            ->keys(publicKey: 'test', name: 'test', model: 'test');

        $this->isInstanceOf(BooleanResponse::class, $actualResponse);
        $this->assertEquals($expectedResponse, $actualResponse->response);
    }
}
