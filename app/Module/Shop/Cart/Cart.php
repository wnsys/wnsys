<?php
namespace App\Module\Shop\Cart;
use App\Core\Framework\Object;
use Illuminate\Support\Collection;

class Cart extends Object
{
    function add(CartItem $cartItem){
       if($item = app("session")->get($cartItem->id)){
           $cartItem->qty += $item->qty;
       }
        app("session")->put($cartItem->id,$cartItem);
        return $cartItem;
    }
}