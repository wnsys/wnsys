<?php
namespace App\Module\Admin\Controllers;
use App\Module\Teacher\Controllers\AdminController;

class MemberController extends AdminController{
    public function index(){

        return view("admin.member.index");
    }

}