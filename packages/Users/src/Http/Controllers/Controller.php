<?php

//namespace Packages\Users\Http\Controllers;
namespace Packages\Users\Http\Controllers;
//namespace Packages\Users\src\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController{

    public function index(){
        return view('welcome');
    }

}



?>