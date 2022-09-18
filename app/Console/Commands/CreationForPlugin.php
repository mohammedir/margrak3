<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Input\InputOption;

class CreationForPlugin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    public $FILE_DIRECTORY = __DIR__ . '../../../../packages/';
    public $MIDDLEWARE_CONTENT = '<?php namespace {change} ;
                                    class {name} {

                                                    /**
                                                     * Handle an incoming request.
                                                     *
                                                     * @param  \Illuminate\Http\Request  $request
                                                     * @param  \Closure  $next
                                                     * @param  string|null  $guard
                                                     * @return mixed
                                                     */
                                                    public function handle($request, Closure $next, $guard = null)
                                                    {
                                                        if (Auth::guard($guard)->check()) {
                                                            return redirect(\'/home\');
                                                        }

                                                        return $next($request);
                                                    }
                                                    }
                                                    ?>';


    public $MODEL_CONTENT = '<?php

                            namespace {namespace};
use Illuminate\Database\Eloquent\Model;



                            class {name} extends Model
                            {

                                /**
                                 * The attributes that are mass assignable.
                                 *
                                 * @var array
                                 */
                                protected $fillable = [
                                    "name", "email", "password",
                                ];

                                /**
                                 * The attributes that should be hidden for arrays.
                                 *
                                 * @var array
                                 */
                                protected $hidden = [
                                    "password", "remember_token",
                                ];
                            }
                            ';

    protected $signature = 'package {name} {--c} {controllerName?} {--mw}  {middlewareName?} {--mo} {modelName?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '-c : Create Controller, -m create Middleware';

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
        $pluginName = $this->argument('name');
        $options = $this->options();

        try {
            $plugin = File::directories(__DIR__ . '../../../../packages/' . $pluginName);
            if ($options['c'] == true && $options['mw'] == true && $options['mo'] == true) {
                $this->makeController($pluginName, 'controllerName');
                $this->makeMiddleware($pluginName, 'middlewareName');
                $this->makeModel($pluginName, 'modelName');
                return;
            } elseif ($options['c'] == true && $options['mw'] == true) {
                $this->makeController($pluginName, 'controllerName');
                $this->makeMiddleware($pluginName, 'middlewareName');
                return;

            } elseif ($options['mw'] == true && $options['mo'] == true) {
                $this->makeMiddleware($pluginName, 'controllerName');
                $this->makeModel($pluginName, 'middlewareName');
                return;

            } elseif ($options['c'] == true && $options['mo'] == true) {
                $this->makeController($pluginName, 'controllerName');
                $this->makeModel($pluginName, 'middlewareName');
                return;

            }

            if ($options['c'] == true) {
                $this->makeController($pluginName, 'controllerName');
                return;
            }
            if ($options['mw'] == true) {
                $this->makeMiddleware($pluginName, 'controllerName');
                return;
            }
            if ($options['mo'] == true) {
                $this->makeModel($pluginName, 'controllerName');
                return;
            }


        } catch (\Exception $exception) {
            $this->info('You should provide an existed plugin name or you should fill all required names');
            $this->info($exception->getMessage());

        }

    }

    private function makeController($pluginName, $controllerName)
    {
        $controllerContent = File::get($this->FILE_DIRECTORY . '/pluginclone/src/Http/Controllers/Controller.php');
        $controllerName = $this->argument($controllerName);

        $newControllerContent = str_replace(['{namespace}'], 'Packages\\' . $pluginName . '\\' . 'src', $controllerContent);
        $newControllerContent = str_replace(['PluginClone'], ucfirst($pluginName), $newControllerContent);
        $newControllerContent = str_replace(['Controller'], ucfirst($controllerName), $newControllerContent);
        $newControllerContent = str_replace(['BaseController'],"BaseController", $newControllerContent);
        $newControllerContent = str_replace(['use Illuminate\Routing\\'.ucfirst($controllerName)],"use Illuminate\\Routing\\Controller", $newControllerContent);
        $newControllerContent = str_replace(['Base'.ucfirst($controllerName)],"BaseController", $newControllerContent);
        File::put($this->FILE_DIRECTORY . '/' . $pluginName . '/src/Http/Controllers/' . ucfirst($controllerName) . '.php', $newControllerContent);
        $this->info('Controller ' . ucfirst($controllerName) . ' has been created successfully');
    }

    private function makeMiddleware($pluginName, $middlewareName)
    {
        $middleName = $this->argument($middlewareName);
        $newContent = str_replace(['{change}'], 'Packages\\' . $pluginName . '\Http\Middleware', $this->MIDDLEWARE_CONTENT);
        $newContent = str_replace(['{name}'], ucfirst($middleName), $newContent);
        File::put($this->FILE_DIRECTORY . '/' . $pluginName . '/src/Http/Middleware/' . ucfirst($middleName) . '.php', $newContent);
        $this->info('Middleware ' . ucfirst($middleName) . ' has been created successfully');
    }

    private function makeModel($pluginName, $modelName)
    {
        $modelName = $this->argument($modelName);
        $this->info($modelName);
        $newContent = str_replace(['{namespace}'], 'Packages\\' . $pluginName, $this->MODEL_CONTENT);
        $newContent = str_replace(['{name}'], ucfirst($modelName), $newContent);
        File::put($this->FILE_DIRECTORY . '/' . $pluginName.'/src/' . ucfirst($modelName) . '.php', $newContent);
        $this->info('Model ' . ucfirst($modelName) . ' has been created successfully');
    }


}
