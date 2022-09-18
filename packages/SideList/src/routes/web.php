<?php
/**
 * Created by PhpStorm.
 * User: AmrSaidam
 * Date: 5/1/2017
 * Time: 10:55 AM
 */
Route::group(['namespace' =>'Packages\SideList\Http\Controllers', "middleware" => ["web", "auth", "admin_u"] ],function(){
    Route::get('/topbtn','SideListController@topbtn');
    Route::get('/sidelist','SideListController@sidelist');
    Route::post('/sidelist','SideListController@sidelist');
    Route::post('/saveImageSidelist','SideListController@saveImageSidelist');
    Route::post('/saveNewTab','SideListController@saveNewTab');
    Route::post('/saveSouqTab','SideListController@saveSouqTab');
});
