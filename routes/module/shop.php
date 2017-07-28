<?php

/*admin*/
Route::group(["namespace"=>"Admin\Controllers"],function (){
    Route::get('/admin/shop', "ShopController@index");
    Route::any('/admin/shop/add', "ShopController@add");
    Route::any('/admin/shop/edit', "ShopController@edit");
    Route::get('/admin/shop/delete', "ShopController@delete");
    Route::post('/admin/shop/upload', "ShopController@upload");

    Route::get('/admin/shop/category', "CategoryController@index");
    Route::any('/admin/shop/category/add', "CategoryController@add");
    Route::any('/admin/shop/category/edit/{id}', "CategoryController@edit");
    Route::get('/admin/shop/category/delete', "CategoryController@delete");
    Route::get('/admin/shop/order', "ShopController@order");
    Route::get('/admin/shop/order/view', "OrderController@view");
    Route::get('/admin/shop/order/delete', "OrderController@delete");
    Route::get('/admin/shop/order/detail', "OrderController@detail");
});

/*web*/
Route::group(["namespace"=>"Index\Controllers"],function (){
    Route::get("/shop/show/{id}","IndexController@show");
    Route::get("/shop/cat/{id}","IndexController@index");
    Route::get("/shop","IndexController@index");
    Route::get("/shop/addCart","IndexController@addCart");
    Route::get("/shop/getCart","IndexController@getCart");
    Route::any("/shop/buy","IndexController@buy");
});


