<?php

namespace Packages\System\Providers;

use Illuminate\Support\ServiceProvider;
use Packages\System\Http\Controllers\Controller;
class SystemServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'SystemTranslator');
        if (app()->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

            $this->publishes([__DIR__ . '/../../resources/views' => resource_path('views/vendor/SystemClone')], 'System');
            $this->publishes([__DIR__ . '/../../resources/lang' => resource_path('lang/vendor/SystemClone')], 'System');
            $this->publishes([
                __DIR__ . '/../../resources/assets' => public_path('vendor/System/packages'),
                __DIR__ . '/../../database/migrations' => resource_path('migration/System'),
//                __DIR__ . '/../../resources/assets' => public_path('vendor/System'),
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
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'System');
        $this->publishes([__DIR__ . '/../../resources/views' => resource_path('views/vendor/System')], 'System');
        $this->publishes([__DIR__ . '/../../resources/lang' => resource_path('lang/vendor/System')], 'System');

//      include '../web/routes.php';
//        $this->app->make('Shift\amrTest\TestController');
    }
}
