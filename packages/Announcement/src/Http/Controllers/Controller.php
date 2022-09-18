<?php

//namespace Packages\Announcement\Http\Controllers;
namespace Packages\Announcement\Http\Controllers;
//namespace Packages\Announcement\src\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController{

    public function index(){
        return view('welcome');
    }

}



?>