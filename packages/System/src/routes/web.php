<?php
/**
 * Created by PhpStorm.
 * User: AmrSaidam
 * Date: 5/1/2017
 * Time: 10:55 AM
 */
Route::group(['namespace' => 'Packages\System\Http\Controllers', "middleware" => ["web", "auth", "admin_u"]], function () {
    Route::get('/siteview', 'System@siteview');
    Route::post('/siteview', 'System@siteview');
    Route::get('/watermark', 'System@watermark');
    Route::post('/watermark', 'System@watermark');
    Route::post('/saveAddsNo', 'System@saveAddsNo');

    Route::get('/blockword', 'System@blockword');
    Route::get('/addBlockword', 'System@addBlockword');
    Route::post('/addBlockword', 'System@addBlockword');
    Route::get('/editBlockword/{id}', 'System@editBlockword');
    Route::get('/deleteBlockword/{id}', 'System@deleteBlockword');
    Route::post('/editBlockword/{id}', 'System@editBlockword');
    Route::get('/statistics', 'System@statistics');

});
Route::group(['namespace' => 'Packages\System\Http\Controllers', "middleware" => ["web", "auth"]], function () {
    Route::post('/system/change', 'System@change');
    Route::post('/system/change1', 'System@change1');
    Route::get('/v_messages', 'System@v_messages');
    Route::get('/readNotification/{id}', 'System@readNotification');

    Route::post('/send_msg', 'System@send_msg');
    Route::get('/send_notification/{s_url_msg}/{adds_id}', 'System@send_notification');
    Route::get('/viewMessages/{id}', 'System@viewMessages');
    Route::get('/delete_msg/{id}', 'System@delete_msg');
});
Route::group(['namespace' => 'Packages\System\Http\Controllers', "middleware" => ["web"]], function () {
    Route::post('/send_msg1', 'System@send_msg1');
});

