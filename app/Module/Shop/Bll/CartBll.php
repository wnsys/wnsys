<?php
namespace App\Module\Shop\Bll;

use App\Core\Bll\Bll;
use App\Module\Shop\Model\ShopCartModel;
use Illuminate\Support\Facades\Auth;

class CartBll extends Bll
{
    function login(){
        
    }
    function add($product_id)
    {
        if ($cart = cookie("cart")) {
            $cart = json_decode($cart);
            if ($cart[$product_id]) {
                $cart[$product_id]["count"] += 1;
            } else {
                $cart[$product_id]["count"] = 1;
            }
        } else {
            $cart[$product_id]["count"] = 1;
        }
        cookie("cart", json_encode($cart));
        //登录情况
        if ($userid = Auth::id()) {
            $product = ShopCartModel::where(["user_id" => $userid, "product_id" => $product_id])->first();
            if ($product) {
                $product->count += 1;
                $product->save();
            } else {
                $product = new ShopCartModel();
                $product->user_id = $userid;
                $product->product_id = $product_id;
                $product->save();
            }
        }

        return true;
    }

    function get($skuid, $userid = 0)
    {

    }
}