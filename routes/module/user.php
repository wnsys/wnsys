<?php

Route::get("/home","IndexController@home");
Route::get("/admin/user","UserController@index");
Route::post("/admin/user/save","UserController@save");
Route::get("/admin/user/get","UserController@get");
Route::get("/admin/user/delete","UserController@delete");