<?php

Route::group(['namespace' => 'Packages\Template\Http\Controllers', "middleware" => ["web", "auth", "admin_u"]], function () {
    Route::get('/templates', 'TemplateController@templates');
    Route::get('/addTemplate', 'TemplateController@addTemplate');
    Route::post('/addTemplate', 'TemplateController@addTemplate');
    Route::post('/addFieldForTemplate', 'TemplateController@addFieldForTemplate');
    Route::get('/editTemplate/{id}', 'TemplateController@editTemplate');
    Route::post('/editTemplate/{id}', 'TemplateController@editTemplate');
    Route::post('/editFieldForTemplate/{id}', 'TemplateController@editFieldForTemplate');
    Route::get('/deleteTemplate/{id}', 'TemplateController@deleteTemplate');
});
Route::group(['namespace' => 'Packages\Template\Http\Controllers', "middleware" => ["web", "auth"]], function () {
    Route::post('/getFieldsOptions', 'TemplateController@getFieldsOptions');
    Route::post('/checkIfCategoryIsTempalted', 'TemplateController@checkIfCategoryIsTempalted');
    Route::post('/getTemplateModalBody', 'TemplateController@getTemplateModalBody');
});
