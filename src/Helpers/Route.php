<?php

namespace NadzorServera\Skijasi\Module\LMSModule\Helpers;

class Route
{
    public static function getController($key)
    {
        $controllers = config('skijasi-lms-module.controllers');

        if (! isset($controllers[$key])) {
            return 'NadzorServera\\Skijasi\\Module\\LMSModule\\Controllers\\'.$key;
        }

        return $controllers[$key];
    }
}
