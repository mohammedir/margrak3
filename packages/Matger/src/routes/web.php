<?php
/**
 * Created by PhpStorm.
 * User: AmrSaidam
 * Date: 5/1/2017
 * Time: 10:55 AM
 */
Route::group(['namespace' =>'Packages\Matger\Http\Controllers' , "middleware" => ["web"]],function(){
    Route::get('/mtger/{id}','MatgerController@mtger');
    Route::post('/mtger/{id}/addDepartment','MatgerController@addDepartment');
    Route::post('/mtger/{id}/{department}/addSubject','MatgerController@addSubject')->name("mtger_add_subject");
    Route::get('/deleteSubject/{id}','MatgerController@deleteSubject');
    Route::get('/deleteDepartment/{id}','MatgerController@deleteDepartment');
});
