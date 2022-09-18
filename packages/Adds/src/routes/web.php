<?php
/**
 * Created by PhpStorm.
 * User: AmrSaidam
 * Date: 5/1/2017
 * Time: 10:55 AM
 */
Route::group(['namespace' => 'Packages\Adds\Http\Controllers', "middleware" => ["web", "auth", "admin_u"]], function () {
    Route::get('/adds', 'Adds@index');
    Route::get('/user_ads', 'Adds@user_ads');
    Route::get('/archives', 'Adds@archives');
    Route::post('/user_ads', 'Adds@user_ads');

    Route::get('/edit_user_ads/{id}', 'Adds@edit_user_ads');
    Route::post('/edit_user_ads/{id}', 'Adds@edit_user_ads');

    Route::post('/adds', 'Adds@index');
    Route::post('/adds/saveCountriesFilterss', 'Adds@saveCountriesFilterss');
    Route::post('/adds/saveASK_VIEW_Filterss', 'Adds@saveASK_VIEW_Filterss');
    Route::post('/adds/saveModel_Filterss', 'Adds@saveModel_Filterss');
    Route::get('/adds_area', 'Adds@adds_area');

    Route::get('/add_adds_area', 'Adds@add_adds_area');
    Route::post('/add_adds_area', 'Adds@add_adds_area');
    Route::get('/edit_adds_area/{id}', 'Adds@edit_adds_area');
    Route::get('/delete_adds_area/{id}', 'Adds@delete_adds_area');
    Route::get('/delete_adds_area1/{id}/{status}', 'Adds@delete_adds_area1');
    Route::get('/delete_adds_area12/{id}', 'Adds@delete_adds_area12');
    Route::post('/edit_adds_area/{id}', 'Adds@edit_adds_area');
});
Route::group(['namespace' => 'Packages\Adds\Http\Controllers', "middleware" => ["web", "auth"]], function () {
    Route::post('/getAreaModalBody', 'Adds@getAreaModalBody');
    Route::post('/getUserAddsModalBody', 'Adds@getUserAddsModalBody');
});
Route::group(['namespace' => 'Packages\Adds\Http\Controllers', "middleware" => ["web"]], function () {
    Route::get('/addurl/{id}', 'Adds@addurl');
});
