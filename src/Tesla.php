<?php

namespace KirilCvetkov\TeslaApi;

use GuzzleHttp\Client;
use KirilCvetkov\TeslaApi\Hydrator\Hydrator;
use KirilCvetkov\TeslaApi\Hydrator\ArrayHydrator;

class Tesla
{
    private HttpClient $httpClient;
    private Hydrator $hydrator;

    public function __construct(string $token)
    {
        $this->httpClient = new HttpClient($token);
        $this->hydrator = new ArrayHydrator();
    }

    public function products()
    {
        return new Products($this->httpClient, $this->hydrator);
    }

    public function vehicles()
    {
        return new Vehicles($this->httpClient, $this->hydrator);
    }
}
