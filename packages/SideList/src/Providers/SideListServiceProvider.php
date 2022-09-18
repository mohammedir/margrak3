<?php

namespace Packages\SideList\Providers;

use Illuminate\Support\ServiceProvider;
use Packages\SideList\Http\Controllers\Controller;
class SideListServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'SideListTranslator');
        if (app()->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

            $this->publishes([__DIR__ . '/../../resources/views' => resource_path('views/vendor/SideListClone')], 'SideList');
            $this->publishes([__DIR__ . '/../../resources/lang' => resource_path('lang/vendor/SideListClone')], 'SideList');
            $this->publishes([
                __DIR__ . '/../../resources/assets' => public_path('vendor/SideList/packages'),
                __DIR__ . '/../../database/migrations' => resource_path('migration/SideList'),
//                __DIR__ . '/../../resources/assets' => public_path('vendor/SideList'),
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
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'SideList');
        $this->publishes([__DIR__ . '/../../resources/views' => resource_path('views/vendor/SideList')], 'SideList');
        $this->publishes([__DIR__ . '/../../resources/lang' => resource_path('lang/vendor/SideList')], 'SideList');

//      include '../web/routes.php';
//        $this->app->make('Shift\amrTest\TestController');
    }
}
