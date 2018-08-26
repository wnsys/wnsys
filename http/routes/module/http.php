<?php
//登录注册相关
Route::group([
    'middleware' => 'web',
    'namespace' => "Controllers",
], function ($router) {
    Route::get('login', "Auth\LoginController@showLoginForm");
    Route::post('login', "Auth\LoginController@login");
    Route::post('logout', "Auth\LoginController@logout");

    Route::get('register', "Auth\RegisterController@showRegistrationForm");
    Route::post('register', "Auth\RegisterController@register");
});