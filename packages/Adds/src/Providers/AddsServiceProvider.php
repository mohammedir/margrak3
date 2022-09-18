<?php

namespace Packages\Adds\Providers;

use Illuminate\Support\ServiceProvider;
use Packages\Adds\Http\Controllers\Controller;
class AddsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'AddsTranslator');
        if (app()->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

            $this->publishes([__DIR__ . '/../../resources/views' => resource_path('views/vendor/AddsClone')], 'Adds');
            $this->publishes([__DIR__ . '/../../resources/lang' => resource_path('lang/vendor/AddsClone')], 'Adds');
            $this->publishes([
                __DIR__ . '/../../resources/assets' => public_path('vendor/Adds/packages'),
                __DIR__ . '/../../database/migrations' => resource_path('migration/Adds'),
//                __DIR__ . '/../../resources/assets' => public_path('vendor/Adds'),
            ], 'assets');
//            $this->publishes([__DIR__ . '/../../config/cms.php' => config_path('cms.php')], 'config');
        }

        $this->app->make(Controller::class);

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'Adds');
        $this->publishes([__DIR__ . '/../../resources/views' => resource_path('views/vendor/Adds')], 'Adds');
        $this->publishes([__DIR__ . '/../../resources/lang' => resource_path('lang/vendor/Adds')], 'Adds');

//      include '../web/routes.php';
//        $this->app->make('Shift\amrTest\TestController');
    }
}
