<?php

namespace NadzorServera\Skijasi\Module\LMSModule\Seeders;

use Illuminate\Database\Seeder;

class SkijasiLMSModuleSeeder extends Seeder
{
    public function run()
    {
        $this->call(LMSPermissionsSeeder::class);
        $this->call(LMSUserSeeder::class);
    }
}
