<?php
namespace App\Module\Admin\Controllers;
use App\Http\Controllers\Controller;

class IndexController extends Controller{
    public function index(){

    }
    public function login(){
        return view("admin.login");
    }
}