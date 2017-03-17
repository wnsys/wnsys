<?php
namespace App\Module\Shop\Cart;

use App\Core\Framework\Object;
use Illuminate\Support\Collection;

class Cart extends Object
{
    private $instance = "cart.default";
    private $session;
    function __construct()
    {
        $this->session = app("session");
    }

    function add(CartItem $cartItem)
    {
        $cart = $this->getCart();
        if ($cart[$cartItem->id]) {
            $cart[$cartItem->id]->qty += $cartItem->qty;
        }else{
            $cart[$cartItem->id] = $cartItem;
        }
        $this->session->put($this->instance, $cart);
        return $cartItem;
    }
    function update($productid,$qty){
        $cart = $this->getCart();
        $item = $this->get($productid);
        $item->qty = $qty;
        if ($item->qty <= 0) {
            unset($cart[$item->id]);
        } else {
            $cart[$productid] = $item;
        }
        $this->session->put($this->instance, $cart);
    }

    function get($productid){
        $cart = $this->getCart();
        return $cart[$productid]?:"";
    }
    public function getCart()
    {
        $content = $this->session->has($this->instance)
            ? $this->session->get($this->instance)
            : [];

        return $content;
    }
    public function destroy()
    {
        $this->session->remove($this->instance);
    }
}