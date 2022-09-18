<?php

Route::group(['namespace' =>'Packages\Block\Http\Controllers' , "middleware" => ["web", "auth", "admin_u"]],function(){
    Route::get('/coins','BlockController@coins');
    Route::post('/coins','BlockController@coins');
    Route::get('/rules','BlockController@rules');
    Route::get('/FAQ','BlockController@FAQ');
    Route::get('/blacklists','BlockController@blacklists');

    Route::get('/addCoins','BlockController@addCoins');
    Route::post('/addCoins','BlockController@addCoins');
    Route::get('/deleteCoins/{id}','BlockController@deleteCoins');
    Route::get('/editCoins/{id}','BlockController@editCoins');
    Route::post('/editCoins/{id}','BlockController@editCoins');

    Route::get('/addBanks','BlockController@addBanks');
    Route::post('/addBanks','BlockController@addBanks');
    Route::get('/editBanks/{id}','BlockController@editBanks');
    Route::get('/deleteBanks/{id}','BlockController@deleteBanks');
    Route::post('/editBanks/{id}','BlockController@editBanks');

    Route::get('/addRules','BlockController@addRules');
    Route::post('/addRules','BlockController@addRules');
    Route::get('/editRules/{id}','BlockController@editRules');
    Route::get('/deleteRules/{id}','BlockController@deleteRules');
    Route::post('/editRules/{id}','BlockController@editRules');

    Route::get('/addFAQ','BlockController@addFAQ');
    Route::post('/addFAQ','BlockController@addFAQ');
    Route::get('/editFAQ/{id}','BlockController@editFAQ');
    Route::get('/deleteFAQ/{id}','BlockController@deleteFAQ');
    Route::post('/editFAQ/{id}','BlockController@editFAQ');

    Route::get('/addBlacklist','BlockController@addBlacklist');
    Route::post('/addBlacklist','BlockController@addBlacklist');
    Route::get('/editBlacklist/{id}','BlockController@editBlacklist');
    Route::get('/deleteBlacklist/{id}','BlockController@deleteBlacklist');
    Route::post('/editBlacklist/{id}','BlockController@editBlacklist');

});

Route::group(['namespace' =>'Packages\Block\Http\Controllers' , "middleware" => ["web"]],function(){
    Route::get('/coinspage','BlockController@coinspage');
    Route::get('/faqpage','BlockController@faqpage');
    Route::get('/rulespage','BlockController@rulespage');
    Route::get('/blacklistpage','BlockController@blacklistpage');
});
