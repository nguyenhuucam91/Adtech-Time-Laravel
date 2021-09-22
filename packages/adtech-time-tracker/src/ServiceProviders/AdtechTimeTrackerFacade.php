<?php

namespace Adtech\AdtechTimeTracker;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Adtech\AdtechTimeTracker\Skeleton\SkeletonClass
 */
class AdtechTimeTrackerFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'adtech-time-tracker';
    }
}
