<?php

declare(strict_types=1);

namespace KirilCvetkov\TeslaApi\Model;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
abstract class AbstractApiResponse
{
    abstract public static function create(array $data): self;
}
