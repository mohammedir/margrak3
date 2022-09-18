<?php

//namespace Packages\PluginClone\Http\Controllers;
namespace Packages\PluginClone\Http\Controllers;
//namespace Packages\PluginClone\src\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;

class MyController extends BaseController{

    public function index(){
        return view('welcome');
    }

}



?>