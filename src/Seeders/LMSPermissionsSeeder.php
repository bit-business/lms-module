<?php

namespace NadzorServera\Skijasi\Module\LMSModule\Seeders;

use Illuminate\Database\Seeder;
use NadzorServera\Skijasi\Models\Permission;

class LMSPermissionsSeeder extends Seeder
{
    public function run()
    {
        Permission::generateFor('courses');
        Permission::generateFor('auth');
    }
}
