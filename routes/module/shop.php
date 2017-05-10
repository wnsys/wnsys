<?php

/*admin*/

Route::get('/admin/shop', "Admin\ShopController@index");
Route::any('/admin/shop/add', "Admin\ShopController@add");
Route::any('/admin/shop/edit', "Admin\ShopController@edit");
Route::get('/admin/shop/delete', "Admin\ShopController@delete");
Route::post('/admin/shop/upload', "Admin\ShopController@upload");

Route::get('/admin/shop/category', "Admin\CategoryController@index");
Route::any('/admin/shop/category/add', "Admin\CategoryController@add");
Route::any('/admin/shop/category/edit/{id}', "Admin\CategoryController@edit");
Route::get('/admin/shop/category/delete', "Admin\CategoryController@delete");
Route::get('/admin/shop/order', "Admin\ShopController@order");
Route::get('/admin/shop/order/view', "Admin\OrderController@view");
/*web*/
Route::get("/shop/show/{id}","IndexController@show");
Route::get("/shop/cat/{id}","IndexController@index");
Route::get("/shop","IndexController@index");
Route::get("/shop/addCart","IndexController@addCart");
Route::get("/shop/getCart","IndexController@getCart");
Route::any("/shop/buy","IndexController@buy");

