<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Providers\ComposerServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;

class CreatePlugins extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    public $FILE_DIRECTORY = __DIR__ . '../../../../packages/';
    public $CLONE_NAME = 'PluginClone';
    protected $signature = 'package:create {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new Plugin Plugin {Name} should be provided';

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
        //
        $name = $this->argument('name');
        try {
            $result = File::directories($this->FILE_DIRECTORY . ''.$name);
            $this->info('The '.$name.' package is already exists');
            return;
        }catch(\InvalidArgumentException $exception){
            File::copyDirectory($this->FILE_DIRECTORY . 'pluginclone', $this->FILE_DIRECTORY . $name);
            $this->updateController($name);
            $this->updateServiceProvider($name);
            $this->updateWebRoute($name);
            $this->updateComposerOfPackage($name);
            $this->updateConfigContent($name);
            $this->updateCommonComposer($name);
            $this->info('vendor:publish');
            $this->call('vendor:publish');
            $this->info('composer dump-autoload');
            shell_exec('composer dump-autoload');
            $this->info('Package ' . $name . ' has been created successfully ...');

        }
//        $this->info(var_dump($result));

    }

    private function updateController($name)
    {
        $controllerContent = File::get($this->FILE_DIRECTORY . '/' . $name . '/src/Http/Controllers/Controller.php');
        $newControllerContent = str_replace(['PluginClone'], $name, $controllerContent);
        File::put($this->FILE_DIRECTORY . '/' . $name . '/src/Http/Controllers/Controller.php', $newControllerContent);
        $this->info('Controller has been initialized successfully ...');


    }

    private function updateServiceProvider($name)
    {
        $fileName = ucfirst($name) . 'ServiceProvider';
        $controllerContent = File::get($this->FILE_DIRECTORY . '/' . $name . '/src/Providers/PluginServiceProvider.php');
        $newControllerContent = str_replace(['PluginClone' , 'plugin' , 'Plugin'], $name, $controllerContent);
//        $newControllerContent = str_replace([], $name, $newControllerContent);
        $newControllerContent = str_replace(['pluginViews'], $name . 'Views', $newControllerContent);
        $newControllerContent = str_replace(['pluginLang'], $name . 'Views', $newControllerContent);
        $newControllerContent = str_replace(['assets/Plugin'], 'assets/' . $name, $newControllerContent);
        $newControllerContent = str_replace(['vendor/Plugin/packages'], 'vendor/' . $name . '/packages', $newControllerContent);
        $newControllerContent = str_replace(['vendor/Plugin'], 'vendor/' . $name, $newControllerContent);
        $newControllerContent = str_replace(['lang/vendor/pluginClone'], 'lang/vendor/' . $name, $newControllerContent);
        $newControllerContent = str_replace(['views/vendor/PluginView'], 'views/vendor/' . $name . 'View', $newControllerContent);
        $newControllerContent = str_replace(['lang/vendor/PluginLang'], 'lang/vendor/' . $name . 'Lang', $newControllerContent);
        $newControllerContent = str_replace(['pluginTranslator'], $name . 'Translator', $newControllerContent);
        $newControllerContent = str_replace(['views/vendor/pluginClone'], 'views/vendor/' . $name . 'Clone', $newControllerContent);
        $newControllerContent = str_replace(['PluginServiceProvider'], ucfirst($name) . 'ServiceProvider', $newControllerContent);
        File::put($this->FILE_DIRECTORY . '/' . $name . '/src/Providers/'.$fileName.'.php', $newControllerContent);
        File::delete($this->FILE_DIRECTORY . '/' . $name . '/src/Providers/PluginServiceProvider.php', $newControllerContent);
        $this->info('ServiceProvider has been initialized successfully ...');

    }

    private function updateWebRoute($name){
        $controllerContent = File::get($this->FILE_DIRECTORY . '/' . $name . '/src/routes/web.php');
        $newRouteContent = str_replace(['PluginClone'], $name, $controllerContent);
        File::put($this->FILE_DIRECTORY . '/' . $name . '/src/routes/web.php', $newRouteContent);
        $this->info('Route has been initialized successfully ...');

    }

    private function updateComposerOfPackage($name){
        $composerContent = File::get($this->FILE_DIRECTORY . '/' . $name . '/composer.json');
        $composerContent = str_replace(['Packages/PluginClone'], 'Packages/'.$name, $composerContent);
        File::put($this->FILE_DIRECTORY . '/' . $name . '/composer.json',$composerContent);
        $this->info('Package Composer.json has been initialized successfully ...');

    }

    private function updateConfigContent($name){
        $newDependancy = "Packages\\PluginClone\\Providers\\PluginServiceProvider::class,
                          Packages\\".$name."\\Providers\\".ucfirst($name).'ServiceProvider::class';
        $configContent = File::get(__DIR__.'../../../../config/app.php');
        $configContent = str_replace(['Packages\PluginClone\Providers\PluginServiceProvider::class'], $newDependancy, $configContent);
        File::put(__DIR__.'../../../../config/app.php',$configContent);
        $this->info('Config/App/Providers Composer.json has been updated successfully ...');

    }

    private function updateCommonComposer($name){
        $json = json_decode(file_get_contents(__DIR__.'../../../../composer.json'), true);
        $json["autoload"]["psr-4"]['Packages\\'.$name.'\\'] =  'packages/'.$name.'/src';
        File::put(__DIR__.'../../../../composer.json',json_encode($json , JSON_PRETTY_PRINT));
        $configContent = File::get(__DIR__.'../../../../composer.json');
        $configContent = str_replace(['\/'], '/', $configContent);
        File::put(__DIR__.'../../../../composer.json',$configContent);
        $this->info('Composer.json has been initialized successfully ...');


    }

}
