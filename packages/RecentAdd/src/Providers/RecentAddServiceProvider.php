<?php

namespace Packages\RecentAdd\Providers;

use Illuminate\Support\ServiceProvider;
use Packages\RecentAdd\Http\Controllers\Controller;
class RecentAddServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'RecentAddTranslator');
        if (app()->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

            $this->publishes([__DIR__ . '/../../resources/views' => resource_path('views/vendor/RecentAddClone')], 'RecentAdd');
            $this->publishes([__DIR__ . '/../../resources/lang' => resource_path('lang/vendor/RecentAddClone')], 'RecentAdd');
            $this->publishes([
                __DIR__ . '/../../resources/assets' => public_path('vendor/RecentAdd/packages'),
                __DIR__ . '/../../database/migrations' => resource_path('migration/RecentAdd'),
//                __DIR__ . '/../../resources/assets' => public_path('vendor/RecentAdd'),
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
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'RecentAdd');
        $this->publishes([__DIR__ . '/../../resources/views' => resource_path('views/vendor/RecentAdd')], 'RecentAdd');
        $this->publishes([__DIR__ . '/../../resources/lang' => resource_path('lang/vendor/RecentAdd')], 'RecentAdd');

//      include '../web/routes.php';
//        $this->app->make('Shift\amrTest\TestController');
    }
}
