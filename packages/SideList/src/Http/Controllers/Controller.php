<?php

//namespace Packages\SideList\Http\Controllers;
namespace Packages\SideList\Http\Controllers;
//namespace Packages\SideList\src\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController{

    public function index(){
        return view('welcome');
    }

}



?>