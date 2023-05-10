<?php

namespace KirilCvetkov\TeslaApi;

use KirilCvetkov\TeslaApi\Model\BooleanResponse;
use KirilCvetkov\TeslaApi\Model\User\Features;
use KirilCvetkov\TeslaApi\Model\User\Me;
use KirilCvetkov\TeslaApi\Model\User\Vault;

class Users extends HttpApi
{
    /**
     * Returns the current user's information.
     *
     * @return Me
     */
    public function me()
    {
        $response = $this->httpGet('/api/1/users/me');

        return $this->hydrateResponse($response, Me::class);
    }

    /**
     * Returns a mystery.
     *
     * @return Vault
     */
    public function vault()
    {
        $response = $this->httpGet('/api/1/users/vault_profile');

        return $this->hydrateResponse($response, Vault::class);
    }

    /**
     * Returns the current user's feature configuration.
     *
     * @return Features
     */
    public function features()
    {
        $response = $this->httpGet('/api/1/users/feature_config');

        return $this->hydrateResponse($response, Features::class);
    }

    /**
     * Update the name of a (bluetooth) key in all vehicles linked to the account.
     * Refreshed inside the vehicle everytime the "Locks" menu is opened.
     *
     * @return BooleanResponse
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

        return $this->hydrateResponse($response, BooleanResponse::class);
    }
}
