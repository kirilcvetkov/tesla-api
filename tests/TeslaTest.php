<?php

declare(strict_types=1);

namespace KirilCvetkov\TeslaApi\Tests;

use KirilCvetkov\TeslaApi\Authenticate;
use KirilCvetkov\TeslaApi\Tesla;

final class TeslaTest extends TestCase
{
    public function testConnect(): void
    {
        // 1. Go to URL and sign in
        // $url = (new Authenticate())->getLoginUrl();
        // d($url);

        // // 2. Copy the 'code' parameter from URL when you land at the 'Page Not Found' page
        // $code = 'code parameter from URL';
        // $token = (new Authenticate())->getToken($code);
        // dd($token);

        // // 3. Start using API
        // $token = 'token';
        // $tesla = new Tesla($token);
        // dd($tesla->products()->index());

        $this->assertTrue(true);
    }
}
