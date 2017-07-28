<?php
namespace App\Module\Shop\Admin\Controllers;
use App\Http\Controllers\Controller;
use App\Module\Shop\Model\ShopOrderModel;
use Illuminate\Http\Request;

class OrderController extends Controller{
    function view(){

        return view("shop.admin.shop.view");
    }
    function delete(Request $request){
        $rs = ShopOrderModel::n()->where("id",$request["id"])->delete();
        return $this->response($rs);
    }
}