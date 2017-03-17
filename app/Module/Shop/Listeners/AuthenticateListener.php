<?php
namespace App\Module\Shop\Listeners;

use App\Module\Shop\Bll\CartBll;
use App\Module\Shop\Cart\Cart;
use App\Module\Shop\Model\ShopCartModel;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Support\Facades\Log;

class AuthenticateListener
{
    public function handle(Authenticated $event)
    {
        $userid = $event->user->getAuthIdentifier();
        $cart = Cart::n()->getCart();
        foreach ($cart as $id=>$item){
            $product = ShopCartModel::where(["product_id" => $id,"user_id"=>$userid])->first();
            if($product){
                $product->qty = $item["qty"];
            }else{
                $product = new ShopCartModel();
                $product->product_id = $item["id"];
                $product->user_id = $userid;
                $product->qty = $item["qty"];

            }
            $product->save();
        }
        Cart::n()->destroy();
    }
}