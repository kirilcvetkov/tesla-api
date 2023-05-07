<?php

declare(strict_types=1);

namespace KirilCvetkov\TeslaApi\Hydrator;

use KirilCvetkov\TeslaApi\Exception\HydrationException;
use KirilCvetkov\TeslaApi\Model\AbstractApiResponse;
use Psr\Http\Message\ResponseInterface;

/**
 * Serialize an HTTP response to domain object.
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
final class ModelHydrator implements Hydrator
{
    /**
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function hydrate(ResponseInterface $response, string $class)
    {
        $body = $response->getBody()->__toString();
        $contentType = $response->getHeaderLine('Content-Type');

        if (0 !== strpos($contentType, 'application/json') && 0 !== strpos($contentType, 'application/octet-stream')) {
            throw new HydrationException('The ModelHydrator cannot hydrate response with Content-Type: ' . $contentType);
        }

        $data = json_decode($body, true);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new HydrationException(sprintf('Error (%d) when trying to json_decode response', json_last_error()));
        }

        if (is_subclass_of($class, AbstractApiResponse::class)) {
            $object = call_user_func([$class, 'create'], $data);
        } else {
            $object = new $class($data);
        }

        if (method_exists($object, 'setRawStream')) {
            $object->setRawStream($response->getBody());
        }

        return $object;
    }
}
