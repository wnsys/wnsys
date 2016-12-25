<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/admin/blog', "BlogController@index");
Route::any('/admin/blog/add', "BlogController@add");
Route::any('/admin/blog/edit', "BlogController@edit");

Route::get('/admin/blog/category', "CategoryController@index");
Route::any('/admin/blog/category/add', "CategoryController@add");
Route::any('/admin/blog/category/edit/{id}', "CategoryController@edit");

Route::get("/blog/{id}","IndexController@show");