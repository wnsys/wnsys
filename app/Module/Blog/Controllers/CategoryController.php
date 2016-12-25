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
use App\Model\Blog\BlogArticleModel;
use App\Model\Blog\BlogCategoryModel;
use Illuminate\Http\Request;

class CategoryController extends AdminController{
    public function index(){
        $data = [];
        return view("blog.category.list", [
            "data" => $data
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
    public function edit(Request $request){
        $data = BlogCategoryModel::find($request["id"]);
        $options = BlogCategoryModel::options();
        return view("blog.category.add", [
            "data" => $data,
            "options" => $options
        ]);
    }
    public function delete(){
        $data = [];
    }
}