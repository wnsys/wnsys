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

        $lists = CategoryBll::treeLists();
        return view("category.list", [
            "data" => $data,
            "lists" => $lists,

        ]);
    }
    public function add(Request $request){
        $data = [];
        if($request["dosubmit"]){
            BlogCategoryModel::modelCreate($request["info"]);
        }
        $templates = CategoryBll::templates("web","list");
        $options = BlogCategoryModel::options();
        return view("category.add", [
            "data" => $data,
            "options" => $options,
            "templates" => $templates
        ]);
    }
    public function edit($id,Request $request){
        $data = BlogCategoryModel::find($id);
        $templates = CategoryBll::templates("web","list");
        if($request["dosubmit"]){
            $data->modelSave($data->id,$request["info"]["name"],$request["info"]["parentid"]);
            return redirect("/admin/blog/category");
        }
        $options = BlogCategoryModel::options($data["parentid"]);
        return view("category.add", [
            "data" => $data,
            "options" => $options
        ]);
    }
    function delete(Request $request)
    {
        BlogCategoryModel::destroy($request["id"]);
        return redirect("/admin/blog/category");
    }
}