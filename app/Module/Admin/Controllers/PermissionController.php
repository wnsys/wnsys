<?php
namespace App\Module\Admin\Controllers;

use App\Http\Controllers\AdminController;
use App\Model\PermissionModel;
use App\Module\Admin\Bll\PermissionBll;
use Symfony\Component\HttpFoundation\Request;

class PermissionController extends AdminController
{
    function index()
    {
        $data = PermissionModel::paginate(10);
        $options = PermissionModel::options();
        return view("admin.permission.index", [
            "data" => $data,
            "options" => $options
        ]);
    }

    function get(Request $request)
    {
        $data = PermissionModel::find($request["id"]);
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