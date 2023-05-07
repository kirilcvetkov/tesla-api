<?php

declare(strict_types=1);

namespace KirilCvetkov\TeslaApi\Model\User;

use KirilCvetkov\TeslaApi\Model\AbstractApiResponse;

final class MeResponse extends AbstractApiResponse
{
    /**
     * @var string[]
     */
    public readonly array $items;

    /**
     * @var int
     */
    public readonly int $totalCount;

    public static function create(array $data): self
    {
        $model = new self();
        $model->totalCount = count($data);
        $model->items = $data['response'];

        return $model;
    }
}
