<?php

namespace KirilCvetkov\TeslaApi;

use GuzzleHttp\Client;

class HttpClient
{
    private readonly string $endpoint;
    private $debug = false;
    private Client $httpClient;

    public function __construct(
        private string|null $token = null,
        private int $timeout = 10,
        string|null $endpoint = null,
    ) {
        $this->endpoint = $endpoint ?? 'https://owner-api.teslamotors.com';
    }

    public function get(): Client
    {
        if (! isset($this->httpClient)) {
            $this->httpClient = new Client([
                'base_uri' => $this->endpoint,
                'timeout'  => $this->timeout,
                'headers' => $this->token ? ['Authorization' => 'Bearer ' . $this->token] : [],
            ]);
        }

        return $this->httpClient;
    }

    public function set(Client $httpClient): self
    {
        $this->httpClient = $httpClient;

        return $this;
    }
}
