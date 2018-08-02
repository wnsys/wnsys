<?php
Route::group([
    'middleware' => 'web',
    'namespace' => "Module\Blog",
], function ($router) {

    /*admin*/
    Route::group(['namespace' => 'Admin\Controllers'], function(){
        // 控制器在 "App\Http\Controllers\Admin" 命名空间下
        Route::get('/admin/blog', "BlogController@index");
        Route::any('/admin/blog/add', "BlogController@add");
        Route::any('/admin/blog/edit', "BlogController@edit");
        Route::get('/admin/blog/delete', "BlogController@delete");
        Route::post('/admin/blog/upload', "BlogController@upload");

        Route::get('/admin/blog/category', "CategoryController@index");
        Route::any('/admin/blog/category/add', "CategoryController@add");
        Route::any('/admin/blog/category/edit/{id}', "CategoryController@edit");
        Route::get('/admin/blog/category/delete', "CategoryController@delete");
    });
    Route::group(['namespace' => 'Index\Controllers'], function(){
        /*web*/
        Route::get("/blog/{id}","IndexController@show");
        Route::get("/blog/cat/{id}","IndexController@lists");

    });
});


