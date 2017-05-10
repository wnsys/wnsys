<?php

/*admin*/

Route::get('/admin/blog', "Admin\BlogController@index");
Route::any('/admin/blog/add', "Admin\BlogController@add");
Route::any('/admin/blog/edit', "Admin\BlogController@edit");
Route::get('/admin/blog/delete', "Admin\BlogController@delete");
Route::post('/admin/blog/upload', "Admin\BlogController@upload");

Route::get('/admin/blog/category', "Admin\CategoryController@index");
Route::any('/admin/blog/category/add', "Admin\CategoryController@add");
Route::any('/admin/blog/category/edit/{id}', "Admin\CategoryController@edit");
Route::get('/admin/blog/category/delete', "Admin\CategoryController@delete");
/*web*/
Route::get("/blog/{id}","Index\IndexController@show");
Route::get("/blog/cat/{id}","Index\IndexController@lists");