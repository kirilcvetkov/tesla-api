<?php

declare(strict_types=1);

namespace KirilCvetkov\TeslaApi\Model;

class Token extends AbstractApiResponse
{
    public readonly string $accessToken;
    public readonly string $idToken;
    public readonly int $expiresIn;
    public readonly string $state;
    public readonly string $tokenType;

    public static function create(array $data): self
    {
        $model = new self();
        $model->accessToken = $data['access_token'] ?? null;
        $model->idToken = $data['id_token'] ?? null;
        $model->expiresIn = $data['expires_in'] ?? 0;
        $model->state = $data['state'] ?? null;
        $model->tokenType = $data['token_type'] ?? null;

        return $model;
    }
}
