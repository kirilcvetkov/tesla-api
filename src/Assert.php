<?php

declare(strict_types=1);

namespace KirilCvetkov\TeslaApi;

use KirilCvetkov\TeslaApi\Exception\InvalidArgumentException;

/**
 * We need to override Webmozart\Assert because we want to throw our own Exception.
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
final class Assert extends \Webmozart\Assert\Assert
{
    protected static function reportInvalidArgument($message)
    {
        throw new InvalidArgumentException($message);
    }
}
