<?php
/**
 * Created by PhpStorm.
 * User: AmrSaidam
 * Date: 5/1/2017
 * Time: 10:55 AM
 */
Route::group(['namespace' => 'Packages\Announcement\Http\Controllers', "middleware" => ["web", "auth", "admin_u"]], function () {
    Route::get('/announcement', 'AnnouncementController@announcement');
    Route::get('/addAnnouncement', 'AnnouncementController@addAnnouncement');
    Route::get('/deleteAnnouncement/{id}', 'AnnouncementController@deleteAnnouncement');
    Route::get('/editAnnouncement/{id}', 'AnnouncementController@editAnnouncement');
    Route::post('/editAnnouncement/{id}', 'AnnouncementController@editAnnouncement');
    Route::post('/addAnnouncement', 'AnnouncementController@addAnnouncement');
});
Route::group(['namespace' => 'Packages\Announcement\Http\Controllers', "middleware" => ["web", "auth"]], function () {
    Route::post('/getAnnouncementBody', 'AnnouncementController@getAnnouncementBody');
});
