<?php

declare(strict_types=1);

namespace KirilCvetkov\TeslaApi\Model\User;

use KirilCvetkov\TeslaApi\Model\AbstractApiResponse;

final class Vault extends AbstractApiResponse
{
    public readonly string $vault;

    public static function create(array $data): self
    {
        $data = $data['response'] ?? [];

        $model = new self();
        $model->vault = $data['vault'] ?? null;

        return $model;
    }
}
