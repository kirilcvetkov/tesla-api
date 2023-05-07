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

        if (!in_array($response->getStatusCode(), [200, 201, 202], true)) {
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
     * @param  array                    $requestOptions Request Options
     * @throws ClientExceptionInterface
     */
    protected function httpGet(string $path, array $parameters = [], array $requestOptions = []): ResponseInterface
    {
        if (count($parameters) > 0) {
            $path .= '?' . http_build_query($parameters);
        }

        try {
            $response = $this->httpClient->getHttpClient()->request('GET', $path, $requestOptions);
        } catch (ClientException $e) {
            throw new HttpServerException($e->getMessage(), $e->getCode(), $e);
        }

        return $response;
    }

    /**
     * Send a POST request with parameters.
     *
     * @param string $path           Request path
     * @param array  $parameters     POST parameters
     * @param array  $requestOptions Request headers
     */
    protected function httpPost(string $path, array $parameters = [], array $requestOptions = []): ResponseInterface
    {
        try {
            $response = $this->httpClient->getHttpClient()->request('POST', $path, $requestOptions);
        } catch (ClientException $e) {
            throw new HttpServerException($e->getMessage(), $e->getCode(), $e);
        }

        return $response;
    }

    /**
     * Send a PUT request.
     *
     * @param  string                   $path           Request path
     * @param  array                    $parameters     PUT parameters
     * @param  array                    $requestHeaders Request headers
     * @throws ClientExceptionInterface
     */
    protected function httpPut(string $path, array $parameters = [], array $requestHeaders = []): ResponseInterface
    {
        try {
            $response = $this->httpClient->sendRequest(
                $this->requestBuilder->create('PUT', $path, $requestHeaders, $this->createRequestBody($parameters))
            );
        } catch (Psr18\NetworkExceptionInterface $e) {
            throw HttpServerException::networkError($e);
        }

        return $response;
    }

    /**
     * Send a DELETE request.
     *
     * @param  string                   $path           Request path
     * @param  array                    $parameters     DELETE parameters
     * @param  array                    $requestHeaders Request headers
     * @throws ClientExceptionInterface
     */
    protected function httpDelete(string $path, array $parameters = [], array $requestHeaders = []): ResponseInterface
    {
        try {
            $response = $this->httpClient->sendRequest(
                $this->requestBuilder->create('DELETE', $path, $requestHeaders, $this->createRequestBody($parameters))
            );
        } catch (Psr18\NetworkExceptionInterface $e) {
            throw HttpServerException::networkError($e);
        }

        return $response;
    }

    /**
     * Prepare a set of key-value-pairs to be encoded as multipart/form-data.
     *
     * @param array $parameters Request parameters
     */
    private function createRequestBody(array $parameters): array
    {
        $resources = [];
        foreach ($parameters as $key => $values) {
            if (!is_array($values)) {
                $values = [$values];
            }
            foreach ($values as $value) {
                $resources[] = [
                    'name' => $key,
                    'content' => $value,
                ];
            }
        }

        return $resources;
    }
}
