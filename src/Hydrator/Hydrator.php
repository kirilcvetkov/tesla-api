<?php

declare(strict_types=1);

namespace KirilCvetkov\TeslaApi\Hydrator;

use KirilCvetkov\TeslaApi\Exception\HydrationException;
use Psr\Http\Message\ResponseInterface;

/**
 * Deserialize a PSR-7 response to something else.
 */
interface Hydrator
{
    /**
     * @param class-string $class
     *
     * @throws HydrationException
     */
    public function hydrate(ResponseInterface $response);
}
