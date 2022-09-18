<?php

namespace Packages\Users\Providers;

use Illuminate\Support\ServiceProvider;
use Packages\Users\Http\Controllers\Controller;
class UsersServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'UsersTranslator');
        if (app()->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

            $this->publishes([__DIR__ . '/../../resources/views' => resource_path('views/vendor/UsersClone')], 'Users');
            $this->publishes([__DIR__ . '/../../resources/lang' => resource_path('lang/vendor/UsersClone')], 'Users');
            $this->publishes([
                __DIR__ . '/../../resources/assets' => public_path('vendor/Users/packages'),
                __DIR__ . '/../../database/migrations' => resource_path('migration/Users'),
//                __DIR__ . '/../../resources/assets' => public_path('vendor/Users'),
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
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'Users');
        $this->publishes([__DIR__ . '/../../resources/views' => resource_path('views/vendor/Users')], 'Users');
        $this->publishes([__DIR__ . '/../../resources/lang' => resource_path('lang/vendor/Users')], 'Users');

//      include '../web/routes.php';
//        $this->app->make('Shift\amrTest\TestController');
    }
}
