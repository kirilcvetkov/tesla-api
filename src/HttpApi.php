<?php

declare(strict_types=1);

namespace KirilCvetkov\TeslaApi;

use GuzzleHttp\Exception\ClientException;
use KirilCvetkov\TeslaApi\Exception\HttpClientException;
use KirilCvetkov\TeslaApi\Exception\HttpServerException;
use KirilCvetkov\TeslaApi\Exception\UnknownErrorException;
use KirilCvetkov\TeslaApi\Hydrator\Hydrator;
use Psr\Http\Client as Psr18;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
abstract class HttpApi
{
    /**
     * The HTTP client.
     *
     * @var ClientInterface
     */
    protected $httpClient;

    /**
     * @var Hydrator|null
     */
    protected $hydrator;

    /**
     * @param ClientInterface $httpClient
     * @param RequestBuilder  $requestBuilder
     * @param Hydrator        $hydrator
     */
    public function __construct($httpClient, Hydrator $hydrator)
    {
        $this->httpClient = $httpClient;
        $this->hydrator = $hydrator;
    }

    /**
     * @return mixed|ResponseInterface
     *
     * @throws \Exception
     */
    protected function hydrateResponse(ResponseInterface $response, string $class)
    {
        if (null === $this->hydrator) {
            return $response;
        }

        if (! in_array($response->getStatusCode(), [200, 201, 202], true)) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, $class);
    }

    /**
     * Throw the correct exception for this error.
     *
     * @throws \Exception
     */
    protected function handleErrors(ResponseInterface $response)
    {
        $statusCode = $response->getStatusCode();
        switch ($statusCode) {
            case 400:
                throw HttpClientException::badRequest($response);
            case 401:
                throw HttpClientException::unauthorized($response);
            case 402:
                throw HttpClientException::requestFailed($response);
            case 403:
                throw HttpClientException::forbidden($response);
            case 404:
                throw HttpClientException::notFound($response);
            case 409:
                throw HttpClientException::conflict($response);
            case 413:
                throw HttpClientException::payloadTooLarge($response);
            case 429:
                throw HttpClientException::tooManyRequests($response);
            case 500 <= $statusCode:
                throw HttpServerException::serverError($statusCode);
            default:
                throw new UnknownErrorException();
        }
    }

    /**
     * Send a GET request with query parameters.
     *
     * @param  string                   $path           Request path
     * @param  array                    $parameters     GET parameters
     * @throws ClientExceptionInterface
     */
    protected function httpGet(string $path, array $parameters = []): ResponseInterface
    {
        if (count($parameters) > 0) {
            $path .= '?' . http_build_query($parameters);
        }

        try {
            $response = $this->httpClient->get()->request('GET', $path);
        } catch (ClientException $e) {
            throw new HttpClientException($e->getMessage(), $e->getCode(), $e);
        } catch (\Throable $e) {
            throw new HttpServerException($e->getMessage(), $e->getCode(), $e);
        }

        return $response;
    }

    /**
     * Send a POST request with parameters.
     *
     * @param string $path           Request path
     * @param array  $parameters     POST parameters
     */
    protected function httpPost(string $path, array $parameters = []): ResponseInterface
    {
        try {
            $response = $this->httpClient->get()
                ->request('POST', $path, ['form_params' => $parameters]);
        } catch (ClientException $e) {
            throw new HttpClientException($e->getMessage(), $e->getCode(), $e);
        } catch (\Throable $e) {
            throw new HttpServerException($e->getMessage(), $e->getCode(), $e);
        }

        return $response;
    }
}
