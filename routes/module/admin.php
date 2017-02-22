<?php
Route::get('/admin', "IndexController@Index");
Route::get('/admin/setting', "IndexController@setting");
Route::get('/admin/avatar', "IndexController@avatar");

Route::get('/admin/role', "RoleController@index");
Route::any('/admin/role/add', "RoleController@add");
Route::any('/admin/role/edit', "RoleController@edit");
Route::get('/admin/role/delete', "RoleController@delete");
Route::get('/admin/role/get', "RoleController@get");

Route::get('/admin/permission', "PermissionController@index");
Route::any('/admin/permission/add', "PermissionController@add");
Route::any('/admin/permission/edit', "PermissionController@edit");
Route::get('/admin/permission/delete', "PermissionController@delete");
Route::get('/admin/permission/get', "PermissionController@get");
Route::post('/admin/permission/save', "PermissionController@saveRelate");

Route::get('/admin/image/get', "ImageController@get");
Route::post('/admin/image/save', "ImageController@save");