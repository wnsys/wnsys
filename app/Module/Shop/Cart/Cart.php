<?php
namespace App\Module\Shop\Cart;

use App\Core\Framework\Object;
use Illuminate\Support\Collection;

class Cart extends Object
{
    private $instance = "cart.default";
    private $session;
    public $items;
    function __construct()
    {
        $this->session = app("session");
        $this->items = $this->session->has($this->instance)
            ? $this->session->get($this->instance)
            : [];
    }

    function add(CartItem $cartItem)
    {
        $item = $this->items[$cartItem->id];
        if ($item) {
            $item["qty"] += $cartItem->qty;
        }else{
            $item = $cartItem->toArray();
        }
        $this->set($item);
        return $item;
    }
    function update($id,$qty){
        $item = $this->items[$id];
        $item["qty"] = $qty;
        if ($item->qty <= 0) {
            unset($this->items[$item["id"]]);
        } else {
            $cart[$id] = $item;
        }
        $this->set($item);
        return $item;
    }

    function get($id){
        return $this->items[$id]?:"";
    }
    function set($item){
        $this->items[$item["id"]] = $item;
        $this->session->put($this->instance, $this->items);
    }

    public function destroy()
    {
        $this->session->remove($this->instance);
    }
}