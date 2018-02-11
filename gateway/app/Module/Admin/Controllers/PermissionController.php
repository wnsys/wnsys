<?php
namespace App\Module\Admin\Controllers;

use App\Http\Controllers\AdminController;
use App\Module\Admin\Model\PermissionModel;
use App\Module\Admin\Model\PermissionRelateModel;
use App\Module\Admin\Bll\PermissionBll;
use Symfony\Component\HttpFoundation\Request;

class PermissionController extends AdminController
{
    function saveRelate(Request $request){
        $info = $request["info"];
        $data = PermissionRelateModel::query()->firstOrCreate($info);
        $info["permission_id"] = implode(",",$request["permission_id"]);
        $data->update($info);
        return redirect("admin/role");
    }
    function index()
    {
        $data = PermissionBll::n()->treeLists();
        $options = PermissionModel::options();
        return view("admin.permission.index", [
            "data" => $data,
            "options" => $options
        ]);
    }

    function get(Request $request)
    {
        $data = PermissionModel::find($request["id"]);
        $data["options"] = PermissionModel::options($data["parentid"]);
        echo json_encode($data);
    }

    function add(Request $request)
    {
        if ($request["dosubmit"]) {
            $request["info"]["parentids"] = PermissionModel::createParentids($request["info"]["parentid"]);
            PermissionModel::create($request["info"]);
        }
        return redirect("admin/permission");
    }

    function edit(Request $request)
    {
        $model = PermissionModel::find($request["id"]);
        if ($model && $request["id"]) {
            $info = $request["info"];
            $info["parentids"] = PermissionModel::createParentids($info["parentid"]);
            $model->update($info);
        }
        return redirect("admin/permission");
    }

    function delete(Request $request)
    {
        PermissionModel::destroy($request["id"]);
        return redirect("admin/permission");
    }

}