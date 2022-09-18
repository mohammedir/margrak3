<?php
/**
 * Created by PhpStorm.
 * User: AmrSaidam
 * Date: 5/1/2017
 * Time: 10:55 AM
 */
Route::group(['namespace' => 'Packages\Users\Http\Controllers', "middleware" => ["web"]], function () {
    Route::get('/newPassword/{e_email}', 'UserController@newPassword');
    Route::post('/newPassword/{e_email}', 'UserController@newPassword');
    Route::get('/resetPassword', 'UserController@resetPassword');
    Route::post('/resetPassword', 'UserController@resetPassword');
    Route::post('/CommentsBody', 'UserController@CommentsBody');
    Route::get('/comments/{id}', 'UserController@comments');
    Route::get('/evaluation/{id}', 'UserController@evaluation');
    Route::post('/evaluation/{id}', 'UserController@evaluation');
    Route::get('/evaluationSubject/{id}', 'UserController@evaluationSubject');
    Route::post('/evaluationSubject/{id}', 'UserController@evaluationSubject');
    Route::get('/contact', 'UserController@contact');
    Route::post('/contact_post', 'UserController@contact_post');
    Route::get('/accountDetails/{id}', 'UserController@accountDetails');
    Route::get('/register', 'UserController@register');
    Route::post('/register', 'UserController@register');
    Route::post('/getCitiesForCountry', 'UserController@getCitiesForCountry');
    Route::get('/logout', "UserController@logout");
});
Route::group(['namespace' => 'Packages\Users\Http\Controllers', "middleware" => ["web"]], function () {
    Route::get('/register', 'UserController@register');
    Route::post('/register', 'UserController@register');
    Route::get('/login', "UserController@login")->name("login");
    Route::post('/login', "UserController@checkLogin");
});
Route::group(['namespace' => 'Packages\Users\Http\Controllers', "middleware" => ["web", "auth", "admin_u"]], function () {
    Route::get('/users', 'UserController@users');
    Route::get('/editUser/{id}', 'UserController@editUser');
    Route::post('/editUser/{id}', 'UserController@editUser');
    Route::get('/block/{id}/{status}', 'UserController@block');
    Route::get('/deleteUser/{id}', 'UserController@deleteUser');
    Route::get('/delMsg/{id}', 'UserController@delMsg');
    Route::get('/manageMessages', 'UserController@manageMessages');
    Route::get('/users_msgs/{id}', 'UserController@users_msgs');
    Route::get('/viewMessages/{id1}/{id2}', 'UserController@viewMessages');

    Route::get('/cities', "UserController@cities");
    Route::post('/cities/add', 'UserController@addCities');
    Route::post('/cities/edit', 'UserController@editCities');
    Route::post('/cities/addCountry', 'UserController@addCountry');
    Route::post('/cities/editCountry', 'UserController@editCountry');
    Route::get('/cities/delete/{id}', 'UserController@deleteCities');

});
Route::group(['namespace' => 'Packages\Users\Http\Controllers', "middleware" => ["web", "auth"]], function () {
    Route::get('/my-adds', 'UserController@my_adds');
    Route::get('/editAccount', 'UserController@editAccount');
    Route::post('/editAccount', 'UserController@editAccount');
});