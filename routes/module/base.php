<?php
Route::get('login', "Auth\LoginController@showLoginForm");
Route::post('login', "Auth\LoginController@login");
Route::post('logout', "Auth\LoginController@logout");