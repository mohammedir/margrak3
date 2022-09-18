<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class DeletePlugin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:delete {name}';
    public $FILE_DIRECTORY = __DIR__ . '/../../../packages/';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove the plugin which has been created before Plugin {Name} should be provided';

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
        $name= $this->argument('name');
        try{
            $configContent = trim(File::get(__DIR__.'/../../../config/app.php'));
            $configContent = str_replace(['Packages\\'.$name.'\Providers\\'.ucfirst($name).'ServiceProvider::class,'], '', $configContent);
            File::put(__DIR__.'/../../../config/app.php',$configContent);
            $this->info('Config/App/Providers have been updated successfully ...');

            $json = json_decode(file_get_contents(__DIR__.'/../../../composer.json'), true);
            unset($json["autoload"]["psr-4"]['Packages\\'.$name.'\\']);
//            $json["autoload"]["psr-4"]['Packages\\'.$name.'\\'] =  'packages/'.$name.'/src';
            File::put(__DIR__.'../../../../composer.json',json_encode($json));
            $configContent = File::get(__DIR__.'/../../../composer.json');
            $configContent = str_replace(['\/'], '/', $configContent);
            File::put(__DIR__.'/../../../composer.json',$configContent);
            $this->info('Composer.json has been updated successfully ...');
            File::deleteDirectory($this->FILE_DIRECTORY.''.$name);
            $this->info('package '.$name.' has been removed successfully ');
            shell_exec('composer dump-autoload');

        }catch(\Exception $exception){
            $this->error('You Should provide a valid package name');
        }
    }
}
