<?php

declare(strict_types=1);

namespace Tests;

use KirilCvetkov\TeslaApi\TeslaApi;
use PHPUnit\Framework\TestCase;

final class TeslaTest extends TestCase
{
    public function testConnect(): void
    {
        (new TeslaApi())->connect(getenv('TEST_USERNAME'), getenv('TEST_PASSWORD'));

        $this->assertTrue(true);
    }
}
