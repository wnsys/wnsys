<?php
namespace App\Module\Member\Controllers;

use App\Model\UserModel;
use App\Module\Teacher\Controllers\AdminController;
use App\User;
use Symfony\Component\HttpFoundation\Request;

class MemberController extends AdminController
{
    public function delete(Request $request)
    {
        $rs = UserModel::destroy($request["id"]);
        return redirect("/admin/member");
    }

    public function index()
    {
        $users = UserModel::paginate(10);
        return view("member.member.index", [
            "data" => $users
        ]);
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            "info.user_name" => "required",
            "info.password" => "required|confirmed",
            "info.password_confirmation" => "required"
        ]);
        if ($request["id"]) {
            $user = UserModel::find($request["id"]);
            $user->password = bcrypt($request["info"]['password']);
            $user->save();
        } else {
            UserModel::create($request["info"]);
        }
        return $this->response("修改成功");
    }

    public function get(Request $request)
    {
        $user = UserModel::find($request["id"])->toArray();
        echo json_encode($user);
    }
}
