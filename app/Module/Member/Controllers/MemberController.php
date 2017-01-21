<?php
namespace App\Module\Member\Controllers;
use App\Model\UserModel;
use App\Module\Teacher\Controllers\AdminController;

class MemberController extends AdminController{
    public function index(){
        $users = UserModel::paginate(10);
        return view("member.member.index",[
            "data" => $users
        ]);
    }

}