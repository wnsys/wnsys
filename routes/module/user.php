<?php

Route::get("/home","Index\IndexController@home");
Route::get("/user/login","Index\LoginController@showLoginForm");
Route::post("/user/login","Index\LoginController@login");
Route::get("/user/blog/add","Index\BlogController@add");


Route::get("/admin/user","Admin\UserController@index");
Route::post("/admin/user/save","Admin\UserController@save");
Route::get("/admin/user/get","Admin\UserController@get");
Route::get("/admin/user/delete","Admin\UserController@delete");