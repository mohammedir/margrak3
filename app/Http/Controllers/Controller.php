<?php

namespace App\Http\Controllers;

use Illuminate\Broadcasting\Broadcasters\PusherBroadcaster;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {

//        Pusher::connection('main')->log('They see me logging…');
//
//// …is identical to writing this
//        Pusher::log('They hatin…');
//
//// and is also identical to writing this.
//        Pusher::connection()->log('Tryin to catch me testing dirty…');
//
//// This is because the main connection is configured to be the default.
//        Pusher::getDefaultConnection(); // This will return main.
//
//// We can change the default connection.
//        Pusher::setDefaultConnection('alternative'); // The default is now alternative.
    }

    public function show(){
        return view('listener');
    }


}
