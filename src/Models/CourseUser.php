<?php

namespace NadzorServera\Skijasi\Module\LMSModule\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use NadzorServera\Skijasi\Module\LMSModule\Enums\CourseUserRole;

class CourseUser extends Pivot
{
    public $incrementing = false;

    protected $casts = [
        'role' => CourseUserRole::class,
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTable(config('skijasi.database.prefix').'course_user');
    }
}
