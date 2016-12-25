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
use App\Model\Blog\BlogCategoryModel;
use Illuminate\Http\Request;

class CategoryController extends AdminController{
    public function index(Request $request){
        $data = [];
        $lists = BlogCategoryModel::lists();
        return view("blog.category.list", [
            "data" => $data,
            "lists" => $lists
        ]);
    }
    public function add(Request $request){
        $data = [];
        if($request["dosubmit"]){
            BlogCategoryModel::create($request["info"]);
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
            $data->update($request["info"]);
            return redirect("/admin/blog/category");
        }
        $options = BlogCategoryModel::options($data["parentid"]);
        return view("blog.category.add", [
            "data" => $data,
            "options" => $options
        ]);
    }
    public function delete(){
        $data = [];
    }
}