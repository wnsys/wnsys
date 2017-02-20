<?php
namespace App\Module\Admin\Controllers;

use App\Model\PermissionModel;
use App\Model\PermissionRelateModel;
use App\Model\RoleModel;
use App\Module\Teacher\Controllers\AdminController;
use Illuminate\Http\Request;

class RoleController extends AdminController
{
    public function get(Request $request)
    {
        $role = RoleModel::find($request["id"])->toArray();
        $permission = PermissionRelateModel::n()->get($request["id"]);
        $role["permission_id"] = $permission["permission_id"]?explode(",",$permission["permission_id"]):[];
        echo json_encode($role);
    }

    public function index(Request $request)
    {
        $data = RoleModel::paginate(10);
        $options = PermissionModel::options();
        return view("admin.role.index", [
            "data" => $data,
            'options' => $options
        ]);
    }

    public function add(Request $request)
    {
        if ($request["dosubmit"]) {
            RoleModel::create($request["info"]);
        }
        return redirect("admin/role");
    }

    public function edit(Request $request)
    {
        $model = RoleModel::find($request["id"]);
        if ($model && $request["id"]) {
            $model->name = $request["info"]["name"];
            $model->save();
        }
        return redirect("admin/role");
    }

    public function delete(Request $request)
    {
        RoleModel::destroy($request["id"]);
        return redirect("admin/role");
    }
}