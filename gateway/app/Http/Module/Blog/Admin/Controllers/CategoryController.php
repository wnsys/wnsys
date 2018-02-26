<?php
namespace App\Http\Module\Blog\Admin\Controllers;
use App\Http\Controllers\AdminController;
use App\Http\Module\Blog\Bll\BlogCategoryBll;
use App\Http\Module\Blog\Bll\CategoryBll;
use App\Http\Module\Blog\Model\BlogCategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends AdminController{
    public function index(Request $request){
        $data = [];

        $lists = BlogCategoryBll::n()->treeLists();
        return view("blog.admin.category.list", [
            "data" => $data,
            "lists" => $lists,

        ]);
    }
    public function add(Request $request){
        $data = [];
        if($request["dosubmit"]){
            BlogCategoryModel::n()->modelCreate($request["info"]);
        }
        $templates = BlogCategoryBll::n()->templates("index","list");
        $options = BlogCategoryModel::n()->options();
        return view("blog.admin.category.add", [
            "data" => $data,
            "options" => $options,
            "templates" => $templates
        ]);
    }
    public function edit($id,Request $request){
        $data = BlogCategoryModel::find($id);
        $templates = BlogCategoryBll::n()->templates("index","list");
        if($request["dosubmit"]){
            $data->mySave($id,$request["info"]);
            return redirect("/admin/blog/category");
        }
        $options = BlogCategoryModel::n()->options($data["parentid"]);
        return view("blog.admin.category.add", [
            "data" => $data,
            "options" => $options,
            "templates" => $templates
        ]);
    }
    function delete(Request $request)
    {
        BlogCategoryModel::destroy($request["id"]);
        return redirect("/admin/blog/category");
    }
}