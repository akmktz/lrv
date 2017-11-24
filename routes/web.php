<?php

// Root
Route::get('/', '\App\Http\Modules\Home\Frontend\Controllers\HomeController@index')->name('home');
Route::get('/admin/', '\App\Http\Modules\Home\Backend\Controllers\HomeController@index')->name('adminHome');

// Pages
Route::get('/admin/pages', '\App\Http\Modules\Pages\Backend\Controllers\SystemController@index')->name('adminPages');
Route::get('/admin/pages/{id}', '\App\Http\Modules\Pages\Backend\Controllers\SystemController@edit')->name('adminPage');
Route::post('/admin/pages/{id}', '\App\Http\Modules\Pages\Backend\Controllers\SystemController@save');
