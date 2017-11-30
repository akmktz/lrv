<?php

// Root
Route::get('/', '\App\Http\Modules\Home\Frontend\Controllers\HomeController@index')->name('home');
Route::get('/admin/', '\App\Http\Modules\Home\Backend\Controllers\HomeController@index')->name('adminHome');

// Pages
Route::post('/admin/pages/status/', '\App\Http\Modules\Pages\Backend\Controllers\SystemController@status');
Route::get('/admin/pages/{id}', '\App\Http\Modules\Pages\Backend\Controllers\SystemController@edit')
    ->where('id', '[\d]+')
    ->name('adminPage');
Route::post('/admin/pages/{id}', '\App\Http\Modules\Pages\Backend\Controllers\SystemController@save')
    ->where('id', '[\d]+');
Route::get('/admin/pages', '\App\Http\Modules\Pages\Backend\Controllers\SystemController@index')->name('adminPages');
