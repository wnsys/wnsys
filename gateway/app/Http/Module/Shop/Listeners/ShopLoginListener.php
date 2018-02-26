<?php
namespace App\Http\Module\Shop\Listeners;

use App\Http\Module\Shop\Bll\CartBll;
use App\Http\Module\Shop\Cart\Cart;
use App\Http\Module\Shop\Model\ShopCartModel;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Log;

class ShopLoginListener
{
    public function handle(Login $event)
    {
        $userid = $event->user->getAuthIdentifier();
        $cart = Cart::n()->getItems("session");
        if($cart){
            foreach ($cart as $id=>$item){
                $product = ShopCartModel::where(["product_id" => $id,"user_id"=>$userid])->first();
                if($product){
                    $product->qty = $item["qty"];
                }else{
                    $product = new ShopCartModel($item);

                }
                $product->save();
            }
            Cart::n()->destroy();
        }

    }
}