<?php

Route::get("/home","IndexController@home");
Route::get("/admin/member","MemberController@index");
Route::post("/admin/member/save","MemberController@save");
Route::get("/admin/member/get","MemberController@get");
Route::get("/admin/member/delete","MemberController@delete");