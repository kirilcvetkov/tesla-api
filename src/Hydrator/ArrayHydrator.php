<?php

declare(strict_types=1);

namespace KirilCvetkov\TeslaApi\Hydrator;

use KirilCvetkov\TeslaApi\Exception\HydrationException;
use Psr\Http\Message\ResponseInterface;

final class ArrayHydrator implements Hydrator
{
    public function hydrate(ResponseInterface $response)
    {
        $body = $response->getBody()->__toString();

        if (strpos($response->getHeaderLine('Content-Type'), 'application/json') !== 0) {
            throw new HydrationException(
                'The ArrayHydrator cannot hydrate response with Content-Type:' .
                $response->getHeaderLine('Content-Type')
            );
        }

        $content = json_decode($body, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new HydrationException(
                sprintf('Error (%d) when trying to json_decode response', json_last_error())
            );
        }

        return $content;
    }
}
