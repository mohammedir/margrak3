<?php
/**
 * Created by PhpStorm.
 * User: AmrSaidam
 * Date: 5/1/2017
 * Time: 10:55 AM
 */
Route::group(['namespace' =>'Packages\Category\Http\Controllers' , "middleware" => ["web", "auth", "admin_u"]],function(){
    Route::get('/categories','CategoryController@index');
    Route::get('/categories/add','CategoryController@add');
    Route::get('/categories/edit/{id}','CategoryController@edit');
    Route::get('/categories/delete/{id}','CategoryController@delete');
    Route::post('/categories/edit/{id}','CategoryController@edit');
    Route::post('/categories/add','CategoryController@add');
});

Route::group(['namespace' =>'Packages\Category\Http\Controllers' , "middleware" => ["web"]],function(){
    Route::post('/categories/getMainCategory','CategoryController@getMainCategory');
});
