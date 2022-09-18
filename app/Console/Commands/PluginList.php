<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class PluginList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    public $FILE_DIRECTORY = __DIR__ . '/../../../packages/';

    protected $signature = 'package:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'list all created packages';

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
        $directories = File::directories($this->FILE_DIRECTORY);
        foreach($directories as $dir){
            $this->info(explode("/\\",$dir)[1]);
        }

    }
}
