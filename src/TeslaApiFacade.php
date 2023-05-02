<?php

namespace Kirilcvetkov\TeslaApi;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Kirilcvetkov\TeslaApi\Skeleton\SkeletonClass
 */
class TeslaApiFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'tesla-api';
    }
}
