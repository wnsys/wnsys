<?php
namespace App\Module\Shop\Bll;

use App\Core\Bll\Bll;
use App\Module\Shop\Model\ShopCartModel;
use Illuminate\Support\Facades\Auth;

class CartBll extends Bll
{
    function add($id)
    {
        if ($cart = cookie("cart")) {
            $cart = json_decode($cart);
            if ($cart[$id]) {
                $cart[$id]["count"] += 1;
            } else {
                $cart[$id]["count"] = 1;
            }
        } else {
            $cart[$id]["count"] = 1;
        }
        cookie("cart", json_encode($cart));
        if ($userid = Auth::id()) {
            $this->store($userid,$id);
        }
        return true;
    }
    function store($userid,$id){
        //登录情况
        $product = ShopCartModel::where(["user_id" => $userid, "product_id" => $id])->first();
        if ($product) {
            $product->count += 1;
            $product->save();
        } else {
            $product = new ShopCartModel();
            $product->user_id = $userid;
            $product->product_id = $id;
            $product->save();
        }

    }

}