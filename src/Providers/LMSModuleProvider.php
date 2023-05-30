<?php

namespace NadzorServera\Skijasi\Module\LMSModule\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use NadzorServera\Skijasi\Module\LMSModule\Commands\LMSModuleSetup;
use NadzorServera\Skijasi\Module\LMSModule\Facades\LMSModule as FacadesSkijasiLMS;
use NadzorServera\Skijasi\Module\LMSModule\LMSModule;

class LMSModuleProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('SkijasiLMSModule', FacadesSkijasiLMS::class);

        $this->app->singleton('skijasi-lms-module', function () {
            return new LMSModule();
        });

        $this->loadMigrationsFrom(__DIR__.'/../Migrations');

        $this->loadRoutesFrom(__DIR__.'/../Routes/api.php');

        $this->publishes([
            __DIR__.'Config/skijasi-lms-module.php' => config_path('skijasi-lms-module.php'),
            __DIR__.'Seeders' => database_path('seeders/Skijasi/LMS'),
        ], 'SkijasiLMSModule');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConsoleComannds();
    }

    /**
     * Register the commands accesible from the console.
     *
     * @return void
     */
    private function registerConsoleComannds()
    {
        $this->commands(LMSModuleSetup::class);
    }
}
