<?php

Route::get('/', '\App\Http\Modules\Home\Frontend\Controllers\HomeController@index')->name('home');
Route::get('/admin/', '\App\Http\Modules\Home\Backend\Controllers\HomeController@index')->name('adminHome');
