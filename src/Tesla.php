<?php

namespace KirilCvetkov\TeslaApi;

use GuzzleHttp\Client;
use KirilCvetkov\TeslaApi\Hydrator\Hydrator;
use KirilCvetkov\TeslaApi\Hydrator\ModelHydrator;

class Tesla
{
    private HttpClient $httpClient;
    private Hydrator $hydrator;

    public function __construct(string $token)
    {
        $this->httpClient = new HttpClient($token);
        $this->hydrator = new ModelHydrator();
    }

    public function products()
    {
        return new Products($this->httpClient, $this->hydrator);
    }

    public function users()
    {
        return new Users($this->httpClient, $this->hydrator);
    }

    public function vehicles()
    {
        return new Vehicles($this->httpClient, $this->hydrator);
    }
}
