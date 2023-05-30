<?php

namespace NadzorServera\Skijasi\Module\LMSModule\Seeders;

use Illuminate\Database\Seeder;
use NadzorServera\Skijasi\Module\LMSModule\Models\User;

class LMSUserSeeder extends Seeder
{
    public function run()
    {
        User::factory()
            ->count(2)
            ->create();
    }
}
