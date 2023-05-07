<?php

namespace KirilCvetkov\TeslaApi;

use GuzzleHttp\Client;
use KirilCvetkov\TeslaApi\Model\User;
use KirilCvetkov\TeslaApi\Exception\HttpServerException;

class Users extends HttpApi
{
    /**
     * Returns the current user's information.
     *
     * @return string[]
     */
    public function me()
    {
        $response = $this->httpGet('/api/1/users/me');

        return $this->hydrateResponse($response, User::class);
    }

    /**
     * Returns a mystery.
     *
     * @return string[]
     */
    public function vault()
    {
        $response = $this->httpGet('/api/1/users/vault_profile');

        return $this->hydrateResponse($response);
    }

    /**
     * Returns the current user's feature configuration.
     *
     * @return string[]
     */
    public function features()
    {
        $response = $this->httpGet('/api/1/users/feature_config');

        return $this->hydrateResponse($response);
    }

    /**
     * Update the name of a (bluetooth) key in all vehicles linked to the account.
     * Refreshed inside the vehicle everytime the "Locks" menu is opened.
     *
     * @return bool
     */
    public function keys(string $publicKey, string $name, string $model)
    {
        $payload = [
            'kind' => 'mobile_device',
            'public_key' => $publicKey,
            'name' => $name,
            'model' => $model,
        ];

        $response = $this->httpPost('/api/1/users/keys', $payload);

        return $this->hydrateResponse($response)->into(User::class);
    }
}