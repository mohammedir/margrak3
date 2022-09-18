<?php
/**
 * Created by PhpStorm.
 * User: AmrSaidam
 * Date: 5/1/2017
 * Time: 10:55 AM
 */
Route::group(['namespace' =>'Packages\PluginClone\Http\Controllers' ],function(){
    Route::get('/test','Controller@index');
});
