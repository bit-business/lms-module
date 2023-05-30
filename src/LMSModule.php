<?php

namespace NadzorServera\Skijasi\Module\LMSModule;

class LMSModule
{
    protected $protected_tables = [
        'course_user',
        'courses',
    ];

    public function getProtectedTables(): array
    {
        return $this->protected_tables;
    }
}
