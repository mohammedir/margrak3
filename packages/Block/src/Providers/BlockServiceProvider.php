<?php

namespace Packages\Block\Providers;

use Illuminate\Support\ServiceProvider;
use Packages\Block\Http\Controllers\Controller;
class BlockServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'BlockTranslator');
        if (app()->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

            $this->publishes([__DIR__ . '/../../resources/views' => resource_path('views/vendor/BlockClone')], 'Block');
            $this->publishes([__DIR__ . '/../../resources/lang' => resource_path('lang/vendor/BlockClone')], 'Block');
            $this->publishes([
                __DIR__ . '/../../resources/assets' => public_path('vendor/Block/packages'),
                __DIR__ . '/../../database/migrations' => resource_path('migration/Block'),
//                __DIR__ . '/../../resources/assets' => public_path('vendor/Block'),
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
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'Block');
        $this->publishes([__DIR__ . '/../../resources/views' => resource_path('views/vendor/Block')], 'Block');
        $this->publishes([__DIR__ . '/../../resources/lang' => resource_path('lang/vendor/Block')], 'Block');

//      include '../web/routes.php';
//        $this->app->make('Shift\amrTest\TestController');
    }
}
