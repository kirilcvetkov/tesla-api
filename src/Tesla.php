<?php

namespace KirilCvetkov\TeslaApi;

use KirilCvetkov\TeslaApi\Hydrator\Hydrator;
use KirilCvetkov\TeslaApi\Hydrator\ModelHydrator;

class Tesla
{
    private Hydrator $hydrator;

    /**
     * @param HttpClient            $httpClient
     * @param Hydrator|null         $hydrator
     */
    public function __construct(private HttpClient $httpClient, Hydrator|null $hydrator = null)
    {
        $this->hydrator = $hydrator ?? new ModelHydrator();
    }

    /**
     * @param  string       $token
     * @param  string|null  $endpoint
     * @return self
     */
    public static function create(string $token, string|null $endpoint = null): self
    {
        return new self(
            new HttpClient(token: $token, endpoint: $endpoint),
            new ModelHydrator()
        );
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
