<?php

namespace Senither\VersionComparison\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Senither\VersionComparison\VersionManager
 */
class Version extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'version';
    }
}
