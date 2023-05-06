<?php

namespace KirilCvetkov\TeslaApi;

use GuzzleHttp\Client;

class HttpClient
{
    private const BASE_URL = 'https://owner-api.teslamotors.com';
    private $debug = false;
    private $httpClient;

    public function __construct(private string $token, private int $timeout = 10)
    {
    }

    public function getHttpClient(): Client
    {
        if (null === $this->httpClient) {
            $this->httpClient = new Client([
                'base_uri' => self::BASE_URL,
                'timeout'  => $this->timeout,
                'headers' => ['Authorization' => 'Bearer ' . $this->token],
            ]);
        }

        return $this->httpClient;
    }

    public function setHttpClient(Client $httpClient): self
    {
        $this->httpClient = $httpClient;

        return $this;
    }
}
