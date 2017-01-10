<?php
namespace App\Module\Admin\Controllers;

use App\Model\RoleModel;
use App\Module\Teacher\Controllers\AdminController;
use Illuminate\Http\Request;

class RoleController extends AdminController
{
    public function get(Request $request)
    {
        echo json_encode(RoleModel::find($request["id"])->toArray());
    }

    public function index(Request $request)
    {
        $data = RoleModel::paginate(10);
        return view("admin.role.list", [
            "data" => $data
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
            $model->name = $request["name"];
            $model->save();
        }
        return redirect("admin/role");
    }

    public function delete(Request $request)
    {

    }
}