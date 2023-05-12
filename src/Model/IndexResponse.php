<?php

declare(strict_types=1);

namespace KirilCvetkov\TeslaApi\Model;

final class IndexResponse extends AbstractApiResponse
{
    /**
     * @var array[]
     */
    public readonly array $items;

    /**
     * @var int
     */
    public readonly int $totalCount;

    public static function create(array $data): self
    {
        $model = new self();
        $model->items = $data['response'] ?? [];
        $model->totalCount = $data['count'] ?? 0;

        return $model;
    }
}
