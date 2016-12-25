<?php
namespace App\Module\Admin\Controllers;
use App\Module\Teacher\Controllers\AdminController;

class SystemController extends AdminController{
    public function index(){

        return view("admin.system.index");
    }

}