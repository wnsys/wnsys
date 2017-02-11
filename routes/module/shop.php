<?php

/*admin*/

Route::get('/admin/shop', "ShopController@index");
Route::any('/admin/shop/add', "ShopController@add");
Route::any('/admin/shop/edit', "ShopController@edit");
Route::get('/admin/shop/delete', "ShopController@delete");
Route::post('/admin/shop/upload', "ShopController@upload");

Route::get('/admin/shop/category', "CategoryController@index");
Route::any('/admin/shop/category/add', "CategoryController@add");
Route::any('/admin/shop/category/edit/{id}', "CategoryController@edit");
Route::get('/admin/shop/category/delete', "CategoryController@delete");
/*web*/
Route::get("/shop/{id}","IndexController@show");
Route::get("/shop/cat/{id}","IndexController@lists");