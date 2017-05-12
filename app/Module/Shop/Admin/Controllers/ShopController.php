<?php
namespace App\Module\Shop\Admin\Controllers;

use App\Http\Controllers\AdminController;
use App\Model\ImageModel;
use App\Module\Shop\Bll\ShopCategoryBll;
use App\Module\Shop\Model\ShopCategoryModel;
use App\Module\Shop\Model\ShopOrderModel;
use App\Module\Shop\Model\ShopProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/26 0026
 * Time: 11:36
 */
class ShopController extends AdminController
{
    function __construct()
    {
        parent::__construct();
        view()->share("options", ShopCategoryModel::n()->options());
    }
    function index(Request $request)
    {
        $query = new ShopProductModel();
        if ($catid = $request["catid"]) {
            $query = $query->where("catid", $catid);
        }
        $catlist = ShopCategoryBll::n()->formSelect("catid", $_GET["catid"]);
        $data = $query->orderBy('id', 'desc')->paginate(10);
        return view("shop.admin.shop.list", [
            "data" => $data,
            "catlist" => $catlist
        ]);
    }

    function edit(Request $request)
    {
        $data = ShopProductModel::where("id", $request["id"])->first();
        if ($request["dosubmit"]) {
            $data->mySave($request);
            ImageModel::n()->mySave($request["id"],$request["imgs"], "shop", "product");
            return redirect("/admin/shop");
        }
        $options = ShopCategoryModel::n()->options($data["catid"]);
        return view("shop.admin.shop.add", [
            "data" => $data,
            'options' => $options
        ]);

    }

    function add(Request $request)
    {
        if ($request["dosubmit"]) {
            $rs = (new ShopProductModel())->mySave($request);
            ImageModel::n()->mySave($rs->id,$request["imgs"], "shop", "product");
            return redirect("/admin/shop");
        }
        return view("shop.admin.shop.add");
    }

    function delete(Request $request)
    {

        ShopProductModel::destroy($request["id"]);
        return redirect("/admin/shop");
    }
    function order(Request $request){
        $catlist = ShopCategoryBll::n()->formSelect("catid",$_GET["catid"]);
        $data = ShopOrderModel::orderBy('id', 'desc')->paginate(10);
        return view("shop.admin.shop.order",[
            "data" => $data,
            "catlist" => $catlist
        ]);
    }
}