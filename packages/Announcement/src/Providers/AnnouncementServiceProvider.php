<?php

namespace Packages\Announcement\Providers;

use Illuminate\Support\ServiceProvider;
use Packages\Announcement\Http\Controllers\Controller;
class AnnouncementServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'AnnouncementTranslator');
        if (app()->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

            $this->publishes([__DIR__ . '/../../resources/views' => resource_path('views/vendor/AnnouncementClone')], 'Announcement');
            $this->publishes([__DIR__ . '/../../resources/lang' => resource_path('lang/vendor/AnnouncementClone')], 'Announcement');
            $this->publishes([
                __DIR__ . '/../../resources/assets' => public_path('vendor/Announcement/packages'),
                __DIR__ . '/../../database/migrations' => resource_path('migration/Announcement'),
//                __DIR__ . '/../../resources/assets' => public_path('vendor/Announcement'),
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
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'Announcement');
        $this->publishes([__DIR__ . '/../../resources/views' => resource_path('views/vendor/Announcement')], 'Announcement');
        $this->publishes([__DIR__ . '/../../resources/lang' => resource_path('lang/vendor/Announcement')], 'Announcement');

//      include '../web/routes.php';
//        $this->app->make('Shift\amrTest\TestController');
    }
}
