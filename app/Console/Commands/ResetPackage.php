<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ResetPackage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    public $FILE_DIRECTORY = __DIR__ . '../../../../packages/';
    protected $signature = 'package:reset {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset the given package to the first formula ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        try {
            File::deleteDirectory($this->FILE_DIRECTORY . '' . $name);
            File::copyDirectory($this->FILE_DIRECTORY . 'pluginclone', $this->FILE_DIRECTORY . $name);
            $this->updateController($name);
            $this->updateServiceProvider($name);
            $this->updateWebRoute($name);
            $this->updateComposerOfPackage($name);
            $this->info('Package ' . $name . ' has been reset successfully');

        } catch (\Exception $exception) {
            $this->info('You should enter a valid package name');
        }
    }

    private function updateController($name)
    {
        $controllerContent = File::get($this->FILE_DIRECTORY . '/' . $name . '/src/Http/Controllers/Controller.php');
        $newControllerContent = str_replace(['PluginClone'], $name, $controllerContent);
        File::put($this->FILE_DIRECTORY . '/' . $name . '/src/Http/Controllers/Controller.php', $newControllerContent);
//        $this->info('Controller has been initialized successfully ...');


    }

    private function updateServiceProvider($name)
    {
        $fileName = ucfirst($name) . 'ServiceProvider';
        $controllerContent = File::get($this->FILE_DIRECTORY . '/' . $name . '/src/Providers/PluginServiceProvider.php');
        $newControllerContent = str_replace(['PluginClone'], $name, $controllerContent);
        $newControllerContent = str_replace(['pluginViews'], $name . 'Views', $newControllerContent);
        $newControllerContent = str_replace(['assets/Plugin'], 'assets/' . $name, $newControllerContent);
        $newControllerContent = str_replace(['vendor/Plugin/packages'], 'vendor/' . $name . '/packages', $newControllerContent);
        $newControllerContent = str_replace(['vendor/Plugin'], 'vendor/' . $name, $newControllerContent);
        $newControllerContent = str_replace(['lang/vendor/pluginClone'], 'lang/vendor/' . $name, $newControllerContent);
        $newControllerContent = str_replace(['views/vendor/PluginView'], 'views/vendor/' . $name . 'View', $newControllerContent);
        $newControllerContent = str_replace(['lang/vendor/PluginLang'], 'lang/vendor/' . $name . 'Lang', $newControllerContent);
        $newControllerContent = str_replace(['pluginTranslator'], $name . 'Translator', $newControllerContent);
        $newControllerContent = str_replace(['views/vendor/pluginClone'], 'views/vendor/' . $name . 'Clone', $newControllerContent);
        $newControllerContent = str_replace(['PluginServiceProvider'], ucfirst($name) . 'ServiceProvider', $newControllerContent);
        File::put($this->FILE_DIRECTORY . '/' . $name . '/src/Providers/' . $fileName . '.php', $newControllerContent);
        File::delete($this->FILE_DIRECTORY . '/' . $name . '/src/Providers/PluginServiceProvider.php', $newControllerContent);
    }

    private function updateWebRoute($name)
    {
        $controllerContent = File::get($this->FILE_DIRECTORY . '/' . $name . '/src/routes/web.php');
        $newRouteContent = str_replace(['PluginClone'], $name, $controllerContent);
        File::put($this->FILE_DIRECTORY . '/' . $name . '/src/routes/web.php', $newRouteContent);
    }

    private function updateComposerOfPackage($name)
    {
        $composerContent = File::get($this->FILE_DIRECTORY . '/' . $name . '/composer.json');
        $composerContent = str_replace(['Packages/PluginClone'], 'Packages/' . $name, $composerContent);
        File::put($this->FILE_DIRECTORY . '/' . $name . '/composer.json', $composerContent);
    }

}
