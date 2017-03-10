<?php
namespace App\Module\Shop\Cart;
use App\Core\Framework\Object;
class Cart extends Object
{
    function add(CartItem $cartItem){
       $rs = app("session")->get();
        app("session")->put("test",1);
        app("session")->store();
    }
}