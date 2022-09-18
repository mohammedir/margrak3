<?php
/**
 * Created by PhpStorm.
 * User: AmrSaidam
 * Date: 5/1/2017
 * Time: 10:55 AM
 */
Route::group(['namespace' => 'Packages\RecentAdd\Http\Controllers', "middleware" => ["web"]], function () {
    Route::get('/market', 'RecentController@market');
    Route::get('/recents', 'RecentController@index');
    Route::post('/constant_mtger/change', 'RecentController@constant_mtger');
    Route::post('/addMatger', 'RecentController@addMatger');
    Route::get('/deleteMatger/{id}', 'RecentController@deleteMatger');
    Route::post('/recents', 'RecentController@index');
    Route::get('/newest', 'RecentController@newest');
    Route::get('/', 'RecentController@newest');
    Route::get('/newest/show/{id}/{title?}', 'RecentController@show');
    Route::post('/insertComment/{id}', 'RecentController@insertComment');
    Route::post('/quoteUser/{id}', 'RecentController@quoteUser');
    Route::post('/change_select', 'RecentController@change_select');
    Route::post('/change_select_for_user', 'RecentController@change_select_for_user');
    Route::post('/change_category', 'RecentController@change_category');
    Route::get('/requestAdd', 'RecentController@requestAdd');
    Route::get('/editAdd/{id}', 'RecentController@editAdd');
    Route::post('/editAdd/{id}', 'RecentController@editAdd');
    Route::post('/AddsReact/{add_id}/{user_id}', 'RecentController@AddsReact');
    Route::post('/AddsReactForSubject/{mtger_id}/{department_id}/{user_id}', 'RecentController@AddsReactForSubject');
});
Route::group(['namespace' => 'Packages\RecentAdd\Http\Controllers', "middleware" => ["web", "auth"]], function () {
    Route::post('/newest/show/{id}/{title?}', 'RecentController@show');
    Route::get('/finishAdds/{id}', 'RecentController@finishAdds');
    Route::get('/commentComplain/{id}', 'RecentController@commentComplain');
    Route::get('/deleteComment/{id}', 'RecentController@deleteComment');
    Route::get('/ruturn_comment/{id}', 'RecentController@ruturn_comment');
    Route::post('/editAdd1/{id}', 'RecentController@editAdd1');
    Route::post('/requestAdd1', 'RecentController@requestAdd1');
    Route::post('/categories/exQuery', 'RecentController@exQuery');
    Route::post('/requestAdd1Image', 'RecentController@requestAdd1Image');
    Route::post('/requestAdd1Image1', 'RecentController@requestAdd1Image1');
    Route::post('/finishAdds/{id}', 'RecentController@finishAdds');
    Route::get('/view_notification', 'RecentController@view_notification');
    Route::get('/view_favorites', 'RecentController@view_favorites');
    Route::get('/view_follows', 'RecentController@view_follows');
});
