<?php

//namespace Packages\System\Http\Controllers;
namespace Packages\System\Http\Controllers;
//namespace Packages\System\src\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController{

    public function index(){
        return view('welcome');
    }

}



?>