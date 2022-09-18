<?php

namespace Packages\Category\Providers;

use Illuminate\Support\ServiceProvider;
use Packages\Category\Http\Controllers\Controller;
class CategoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'CategoryTranslator');
        if (app()->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

            $this->publishes([__DIR__ . '/../../resources/views' => resource_path('views/vendor/CategoryClone')], 'Category');
            $this->publishes([__DIR__ . '/../../resources/lang' => resource_path('lang/vendor/CategoryClone')], 'Category');
            $this->publishes([
                __DIR__ . '/../../resources/assets' => public_path('vendor/Category/packages'),
                __DIR__ . '/../../database/migrations' => resource_path('migration/Category'),
//                __DIR__ . '/../../resources/assets' => public_path('vendor/Category'),
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
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'Category');
        $this->publishes([__DIR__ . '/../../resources/views' => resource_path('views/vendor/Category')], 'Category');
        $this->publishes([__DIR__ . '/../../resources/lang' => resource_path('lang/vendor/Category')], 'Category');

//      include '../web/routes.php';
//        $this->app->make('Shift\amrTest\TestController');
    }
}
