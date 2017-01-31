<?php
namespace App\Module\Member\Controllers;
use App\Model\UserModel;
use App\Module\Teacher\Controllers\AdminController;
use App\User;
use Symfony\Component\HttpFoundation\Request;

class MemberController extends AdminController{
    public function index(){
        $users = UserModel::paginate(10);
        return view("member.member.index",[
            "data" => $users
        ]);
    }
    public function save(Request $request){
        if($request["id"]){
            $user = UserModel::find($request["id"])->toArray();
            $user->password = bcrypt($request['password']);
            $user->save();
        }else{
            $this->validate($request,[
                "info.user_name" => "required",
                "info.password" => "required",
                "info.check_password" => "required|confirmed"
            ]);

            UserModel::create($request["info"]);
        }
        return redirect("/admin/member");
    }
    public function ajaxGet(Request $request){
       $user = UserModel::find($request["id"])->toArray();
        echo json_encode($user);
    }
}
