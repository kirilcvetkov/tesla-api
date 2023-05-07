<?php

declare(strict_types=1);

namespace KirilCvetkov\TeslaApi\Model;

class BoolResponse extends AbstractApiResponse
{
    public readonly bool $response;

    public static function create(array $data): self
    {
        $model = new self();
        $model->response = $data['response'] ?? null;

        return $model;
    }
}
