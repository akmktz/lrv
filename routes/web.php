<?php

// Root
Route::get('/', '\App\Http\Modules\Home\Frontend\Controllers\HomeController@index')->name('home');
Route::get('/admin/', '\App\Http\Modules\Home\Backend\Controllers\HomeController@index')->name('adminHome');

// Pages
Route::post('/admin/pages/status/', '\App\Http\Modules\Pages\Backend\Controllers\SystemController@status');
Route::get('/admin/pages/{id}', '\App\Http\Modules\Pages\Backend\Controllers\SystemController@edit')
    ->where('id', '[\d]+')
    ->name('adminSystemEdit');
Route::post('/admin/pages/{id}', '\App\Http\Modules\Pages\Backend\Controllers\SystemController@save')
    ->where('id', '[\d]+');
Route::get('/admin/pages', '\App\Http\Modules\Pages\Backend\Controllers\SystemController@index')
    ->name('adminSystemList');

// Catalog
// Groups
Route::post('/admin/groups/status/', '\App\Http\Modules\Catalog\Backend\Controllers\GroupsController@status');
Route::post('/admin/groups/sort/', '\App\Http\Modules\Catalog\Backend\Controllers\GroupsController@sort');
Route::post('/admin/groups/add', '\App\Http\Modules\Catalog\Backend\Controllers\GroupsController@save');
Route::get('/admin/groups/add', '\App\Http\Modules\Catalog\Backend\Controllers\GroupsController@add')
    ->name('adminGroupsAdd');
Route::get('/admin/groups/{id}', '\App\Http\Modules\Catalog\Backend\Controllers\GroupsController@edit')
    ->where('id', '[\d]+')
    ->name('adminGroup');
Route::post('/admin/groups/{id}', '\App\Http\Modules\Catalog\Backend\Controllers\GroupsController@save')
    ->where('id', '[\d]+')
    ->name('adminGroupsEdit');
Route::get('/admin/groups', '\App\Http\Modules\Catalog\Backend\Controllers\GroupsController@index')
    ->name('adminGroupsList');
// Items
Route::post('/admin/items/status/', '\App\Http\Modules\Catalog\Backend\Controllers\ItemsController@status');
Route::post('/admin/items/add', '\App\Http\Modules\Catalog\Backend\Controllers\ItemsController@save');
Route::get('/admin/items/add', '\App\Http\Modules\Catalog\Backend\Controllers\ItemsController@add')
    ->name('adminItemsAdd');
Route::get('/admin/items/{id}', '\App\Http\Modules\Catalog\Backend\Controllers\ItemsController@edit')
    ->where('id', '[\d]+')
    ->name('adminItemsEdit');
Route::post('/admin/items/{id}', '\App\Http\Modules\Catalog\Backend\Controllers\ItemsController@save')
    ->where('id', '[\d]+');
Route::get('/admin/items', '\App\Http\Modules\Catalog\Backend\Controllers\ItemsController@index')->name('adminItemsList');

