<?php

namespace Packages\PluginClone\Providers;

use Illuminate\Support\ServiceProvider;
use Packages\PluginClone\Http\Controllers\Controller;
class PluginServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'pluginTranslator');
        if (app()->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

            $this->publishes([__DIR__ . '/../../resources/views' => resource_path('views/vendor/pluginClone')], 'plugin');
            $this->publishes([__DIR__ . '/../../resources/lang' => resource_path('lang/vendor/pluginClone')], 'plugin');
            $this->publishes([
                __DIR__ . '/../../resources/assets' => public_path('vendor/Plugin/packages'),
                __DIR__ . '/../../database/migrations' => resource_path('migration/Plugin'),
//                __DIR__ . '/../../resources/assets' => public_path('vendor/Plugin'),
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
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'plugin');
        $this->publishes([__DIR__ . '/../../resources/views' => resource_path('views/vendor/plugin')], 'plugin');
        $this->publishes([__DIR__ . '/../../resources/lang' => resource_path('lang/vendor/plugin')], 'plugin');

//      include '../web/routes.php';
//        $this->app->make('Shift\amrTest\TestController');
    }
}
