<?php

//namespace Packages\Adds\Http\Controllers;
namespace Packages\Adds\Http\Controllers;
//namespace Packages\Adds\src\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController{

    public function index(){
        return view('welcome');
    }

}



?>