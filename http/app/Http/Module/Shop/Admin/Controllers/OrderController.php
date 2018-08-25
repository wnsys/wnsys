<?php
namespace App\Http\Module\Shop\Admin\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Module\Shop\Model\ShopOrderModel;
use Illuminate\Http\Request;

class OrderController extends Controller{
    function view(){

        return view("shop.admin.shop.view");
    }
    function delete(Request $request){
        $rs = ShopOrderModel::n()->where("id",$request["id"])->delete();
        return redirect("/admin/shop/order");
    }
    function detail(Request $request){
        $rs = ShopOrderModel::n()->where("id",$request["id"])->with("detail.product")->first();
        echo json_encode($rs);
    }
}