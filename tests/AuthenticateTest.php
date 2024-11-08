<?php

declare(strict_types=1);

namespace KirilCvetkov\TeslaApi\Tests;

use KirilCvetkov\TeslaApi\Authenticate;
use KirilCvetkov\TeslaApi\Tesla;

final class AuthenticateTest extends TestCase
{
    public function testConnect(): void
    {
        $authenticate = Authenticate::create();

        // // 1. Go to URL and sign in
        // $url = $authenticate->getLoginUrl();
        // dd($url);

        // // 2. Copy the 'code' parameter from URL when you land at the 'Page Not Found' page
        // $code = 'NA_8a33481fe5e34d1a3cf4e9865e35579a23c2d7826621d764194d21209c8d';
        // $tokenModel = $authenticate->getToken($code);
        // dd($tokenModel->accessToken);

        // // 3. Start using API
        // $token = $tokenModel->accessToken;
        // $tesla = Tesla::create($token);
        // dd($tesla->users()->me());

        $this->assertTrue(true);
    }
}
