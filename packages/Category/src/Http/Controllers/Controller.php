<?php

//namespace Packages\Category\Http\Controllers;
namespace Packages\Category\Http\Controllers;
//namespace Packages\Category\src\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController{

    public function index(){
        return view('welcome');
    }

}



?>