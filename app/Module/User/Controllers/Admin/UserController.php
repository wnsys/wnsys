<?php
namespace App\Module\User\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Module\Admin\Model\RoleModel;
use App\Module\Admin\Model\RoleUserModel;
use App\Model\UserModel;
use App\User;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AdminController
{
    public function delete(Request $request)
    {
        $rs = UserModel::destroy($request["id"]);
        return redirect("/admin/user");
    }

    public function index()
    {
        $users = UserModel::paginate(10);
        $roles = RoleModel::get();
        return view("user.admin.user.index", [
            "data" => $users,
            "roles" => $roles
        ]);
    }

    public function save(Request $request)
    {

        if ($request["id"]) {
            $user = UserModel::find($request["id"]);
            if($request["info"]['password']){
                $user->password = bcrypt($request["info"]['password']);
            }
            $user->save();
            $role = RoleUserModel::firstOrCreate(["user_id"=>$request["id"]]);
            $role->role_id = $request["role_id"];
            $role->save();
            $message = "修改成功";
        } else {
            $this->validate($request, [
                "info.user_name" => "required",
                "info.password" => "required|confirmed",
                "info.password_confirmation" => "required"
            ]);
            UserModel::create($request["info"]);
            RoleUserModel::Create(["user_id"=>$request["id"],"role_id"=>$request["role_id"]]);
            $message = "添加成功";
        }
        return $this->message($message);
    }

    public function get(Request $request)
    {
        $user = UserModel::find($request["id"])->toArray();
        $role_user = RoleUserModel::where(["user_id"=>$user["id"]])->first();
        $user["role_id"] = $role_user->role_id;
        echo json_encode($user);
    }
}
