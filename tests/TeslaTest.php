<?php

declare(strict_types=1);

namespace Tests;

use KirilCvetkov\TeslaApi\Authenticate;
use KirilCvetkov\TeslaApi\TeslaApi;
use PHPUnit\Framework\TestCase;

final class TeslaTest extends TestCase
{
    public function testConnect(): void
    {
        // 1. Go to URL and sign in
        dd((new Authenticate())->generateLoginUrl());

        // 2. Copy the 'code' parameter from URL when you land at the 'Page Not Found' page
        $code = 'code from URL';
        $token = (new Authenticate())->getToken($code);

        // 3. Start using API
        $tesla = new TeslaApi($token);
        dd($tesla->list($token));

        $this->assertTrue(true);
    }
}
