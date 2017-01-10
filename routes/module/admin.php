<?php
Route::get('/admin', "IndexController@Index");
Route::get('/admin/setting', "IndexController@setting");
Route::get('/admin/avatar', "IndexController@avatar");

Route::get('/admin/role', "RoleController@index");
Route::any('/admin/role/add', "RoleController@add");
Route::any('/admin/role/edit', "RoleController@edit");
Route::get('/admin/role/delete', "RoleController@delete");
Route::get('/admin/role/get', "RoleController@get");