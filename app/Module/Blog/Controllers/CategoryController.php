<?php
/**
 * Created by wnsys.net
 * User: weining
 * Email: 178441367@qq.com
 * Date: 2016/12/24
 * Time: 16:38
 */
namespace App\Module\Blog\Controllers;
use App\Http\Controllers\AdminController;
use App\Module\Blog\Bll\CategoryBll;
use App\Module\Blog\Model\BlogCategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends AdminController{
    public function index(Request $request){
        $data = [];
        $lists = CategoryBll::lists();
        return view("blog.category.list", [
            "data" => $data,
            "lists" => $lists
        ]);
    }
    public function add(Request $request){
        $data = [];
        if($request["dosubmit"]){
            BlogCategoryModel::modelCreate($request["info"]);
        }
        $options = BlogCategoryModel::options();
        return view("blog.category.add", [
            "data" => $data,
            "options" => $options
        ]);
    }
    public function edit($id,Request $request){
        $data = BlogCategoryModel::find($id);
        if($request["dosubmit"]){
            $data->modelSave($data->id,$request["info"]["name"],$request["info"]["parentid"]);
            return redirect("/admin/blog/category");
        }
        $options = CategoryBll::options($data["parentid"]);
        return view("blog.category.add", [
            "data" => $data,
            "options" => $options
        ]);
    }
    public function delete(){
        $data = [];
    }
}