<?php

//namespace Packages\RecentAdd\Http\Controllers;
namespace Packages\RecentAdd\Http\Controllers;
//namespace Packages\RecentAdd\src\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController{

    public function index(){
        return view('welcome');
    }

}



?>