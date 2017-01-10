<?php
namespace App\Module\Admin\Controllers;
use App\Model\RoleModel;
use App\Module\Teacher\Controllers\AdminController;
use Illuminate\Http\Request;

class RoleController extends AdminController{
    public function index(){
        $data = RoleModel::all();
        return view("admin.role.list",[
            "data" => $data
        ]);
    }
    public function add(Request $request){
        return view("admin.role.add");
    }
    public function edit(Request $request){
        return view("admin.role.add");
    }
    public function delete(Request $request){

    }
}