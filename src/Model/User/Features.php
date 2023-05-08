<?php

declare(strict_types=1);

namespace KirilCvetkov\TeslaApi\Model\User;

use KirilCvetkov\TeslaApi\Model\AbstractApiResponse;

final class Features extends AbstractApiResponse
{
    public readonly bool $signalingEnabled;
    public readonly bool $subscribeConnectivity;

    public static function create(array $data): self
    {
        $data = $data['response'] ?? [];

        $model = new self();
        $model->signalingEnabled = $data['signaling']['enabled'] ?? false;
        $model->subscribeConnectivity = $data['signaling']['subscribe_connectivity'] ?? false;

        return $model;
    }
}
