<?php

Route::group([
    'middleware' => 'web',
    'namespace' => "Module\Web\Controllers",
], function ($router) {
    Route::get("/","IndexController@index");
    Route::get("/index","IndexController@index");
    Route::get("/xiao","IndexController@xiao");
});




