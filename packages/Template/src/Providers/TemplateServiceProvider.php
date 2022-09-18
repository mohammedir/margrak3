<?php

namespace Packages\Template\Providers;

use Illuminate\Support\ServiceProvider;
use Packages\Template\Http\Controllers\Controller;
class TemplateServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'TemplateTranslator');
        if (app()->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

            $this->publishes([__DIR__ . '/../../resources/views' => resource_path('views/vendor/TemplateClone')], 'Template');
            $this->publishes([__DIR__ . '/../../resources/lang' => resource_path('lang/vendor/TemplateClone')], 'Template');
            $this->publishes([
                __DIR__ . '/../../resources/assets' => public_path('vendor/Template/packages'),
                __DIR__ . '/../../database/migrations' => resource_path('migration/Template'),
//                __DIR__ . '/../../resources/assets' => public_path('vendor/Template'),
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
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'Template');
        $this->publishes([__DIR__ . '/../../resources/views' => resource_path('views/vendor/Template')], 'Template');
        $this->publishes([__DIR__ . '/../../resources/lang' => resource_path('lang/vendor/Template')], 'Template');

//      include '../web/routes.php';
//        $this->app->make('Shift\amrTest\TestController');
    }
}
