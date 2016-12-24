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

class CategoryController extends AdminController{
    public function index(){
        $data = [];
        return view("blog.category.list", [
            "data" => $data
        ]);
    }
    public function add(){
        $data = [];
        return view("blog.category.list", [
            "data" => $data
        ]);
    }
    public function edit(){
        $data = [];
        return view("blog.category.list", [
            "data" => $data
        ]);
    }
    public function delete(){
        $data = [];
        return view("blog.category.list", [
            "data" => $data
        ]);
    }
}