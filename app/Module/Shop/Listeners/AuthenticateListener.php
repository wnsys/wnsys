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
        myLog("AuthenticateListener:userid:".$userid);
        $cart = Cart::n()->getCart();
        myLog("AuthenticateListener:cart:".$cart);
        foreach ($cart as $prodcutid=>$item){
            $prodcut = ShopCartModel::where(["prodcutid" => $prodcutid,"user_id"=>$userid])->first();
            if($prodcut){
                $prodcut->qty = $item->qty;
            }else{
                $prodcut = new ShopCartModel();
                $prodcut->product_id = $item->id;
                $prodcut->user_id = $userid;
                $prodcut->qty = $item->id;

            }
            $f = $prodcut->save();
            myLog("AuthenticateListener:save:".$f);
            $prodcut->save();
        }
        Cart::n()->destroy();

    }
}