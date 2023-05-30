<?php

namespace NadzorServera\Skijasi\Module\LMSModule\Facades;

use Illuminate\Support\Facades\Facade;

class LMSModule extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'skijasi-lms-module';
    }
}
