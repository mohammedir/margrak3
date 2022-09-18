<?php

//namespace Packages\Template\Http\Controllers;
namespace Packages\Template\Http\Controllers;
//namespace Packages\Template\src\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController{

    public function index(){
        return view('welcome');
    }

}



?>