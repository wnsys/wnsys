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
Route::get('login', "Auth\LoginController@showLoginForm");
Route::get('logout', "Auth\LoginController@showLoginForm");
Route::post('logout', "Auth\LoginController@logout");
/*Route::get('register', "Auth\RegisterController@showRegistrationForm");
Route::post('register', "Auth\RegisterController@register");*/

