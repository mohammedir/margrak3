<?php

namespace Packages\Matger\Providers;

use Illuminate\Support\ServiceProvider;
use Packages\Matger\Http\Controllers\Controller;
class MatgerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'MatgerTranslator');
        if (app()->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

            $this->publishes([__DIR__ . '/../../resources/views' => resource_path('views/vendor/MatgerClone')], 'Matger');
            $this->publishes([__DIR__ . '/../../resources/lang' => resource_path('lang/vendor/MatgerClone')], 'Matger');
            $this->publishes([
                __DIR__ . '/../../resources/assets' => public_path('vendor/Matger/packages'),
                __DIR__ . '/../../database/migrations' => resource_path('migration/Matger'),
//                __DIR__ . '/../../resources/assets' => public_path('vendor/Matger'),
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
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'Matger');
        $this->publishes([__DIR__ . '/../../resources/views' => resource_path('views/vendor/Matger')], 'Matger');
        $this->publishes([__DIR__ . '/../../resources/lang' => resource_path('lang/vendor/Matger')], 'Matger');

//      include '../web/routes.php';
//        $this->app->make('Shift\amrTest\TestController');
    }
}
