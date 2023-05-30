<?php

namespace NadzorServera\Skijasi\Module\LMSModule\Helpers;

class DatabaseHelper
{
    public static function getSkijasiTableName($tableName)
    {
        return config('skijasi.database.prefix').$tableName;
    }
}
