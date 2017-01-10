<?php
Route::get('/admin', "IndexController@Index");
Route::get('/admin/setting', "IndexController@setting");
Route::get('/admin/avatar', "IndexController@avatar");

Route::get('/admin/role', "RoleController@index");
Route::get('/admin/role/add', "RoleController@add");
Route::get('/admin/role/edit/{id}', "RoleController@edit");