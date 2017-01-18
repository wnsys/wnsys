<?php

/*admin*/

Route::get('/admin/blog', "BlogController@index");
Route::any('/admin/blog/add', "BlogController@add");
Route::any('/admin/blog/edit', "BlogController@edit");
Route::get('/admin/blog/delete', "BlogController@delete");
Route::post('/admin/blog/upload', "BlogController@upload");

Route::get('/admin/blog/category', "CategoryController@index");
Route::any('/admin/blog/category/add', "CategoryController@add");
Route::any('/admin/blog/category/edit/{id}', "CategoryController@edit");
Route::get('/admin/blog/category/delete', "CategoryController@delete");
/*web*/
Route::get("/blog/{id}","IndexController@show");
Route::get("/blog/cat/{id}","IndexController@lists");