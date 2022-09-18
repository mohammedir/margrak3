<?php

//namespace Packages\Block\Http\Controllers;
namespace Packages\Block\Http\Controllers;
//namespace Packages\Block\src\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController{

    public function index(){
        return view('welcome');
    }

}



?>