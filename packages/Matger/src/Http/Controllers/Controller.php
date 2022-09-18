<?php

//namespace Packages\Matger\Http\Controllers;
namespace Packages\Matger\Http\Controllers;
//namespace Packages\Matger\src\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController{

    public function index(){
        return view('welcome');
    }

}



?>