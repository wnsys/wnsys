<?php
/**
 * Created by wnsys.net
 * User: weining
 * Email: 178441367@qq.com
 * Date: 2016/12/24
 * Time: 16:38
 */
namespace App\Module\Shop\Controllers;
use App\Http\Controllers\AdminController;
use App\Module\Shop\Bll\ShopCategoryBll;
use App\Module\Shop\Model\ShopCategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends AdminController{
    public function index(){
        $data = [];
        $lists = ShopCategoryBll::n()->treeLists();
        return view("category.list", [
            "data" => $data,
            "lists" => $lists,
        ]);
    }
    public function add(Request $request){
        $data = [];
        if($request["dosubmit"]){
            ShopCategoryModel::n()->modelCreate($request["info"]);
        }
        $templates = ShopCategoryBll::n()->templates("index","list");
        $options = ShopCategoryModel::n()->options();
        return view("category.add", [
            "data" => $data,
            "options" => $options,
            "templates" => $templates
        ]);
    }
    public function edit($id,Request $request){
        $data = ShopCategoryModel::find($id);
        $templates = ShopCategoryBll::n()->templates("index","list");
        if($request["dosubmit"]){
            $data->mySave($id,$request["info"]);
            return redirect("/admin/shop/category");
        }
        $options = ShopCategoryModel::n()->options($data["parentid"]);
        return view("category.add", [
            "data" => $data,
            "options" => $options,
            "templates" => $templates
        ]);
    }
    function delete(Request $request)
    {
        ShopCategoryModel::destroy($request["id"]);
        return redirect("/admin/blog/category");
    }
}