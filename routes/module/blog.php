<?php

/*admin*/

Route::get('/admin/blog', "BlogController@index");
Route::any('/admin/blog/add', "BlogController@add");
Route::any('/admin/blog/edit', "BlogController@edit");
Route::get('/admin/blog/delete', "BlogController@delete");

Route::get('/admin/blog/category', "CategoryController@index");
Route::any('/admin/blog/category/add', "CategoryController@add");
Route::any('/admin/blog/category/edit/{id}', "CategoryController@edit");

/*web*/
Route::get("/blog/{id}","IndexController@show");