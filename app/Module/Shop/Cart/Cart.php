<?php
namespace App\Module\Shop\Cart;

use App\Core\Framework\Object;
use App\Module\Shop\Model\ShopCartModel;
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
        $item = $this->items[$cartItem->product_id];
        if ($item) {
            $item["qty"] += $cartItem->qty;
        } else {
            $item = $cartItem->toArray();
        }
        $this->set($item);
        if(Auth::check()){
            $item = ShopCartModel::where(["user_id"=>Auth::id(),"product_id"=>$cartItem->id])->first();
            if($item){
                $item->qty += $cartItem->qty;
                $item->save();
            } else{
                $item = new ShopCartModel();
                $item->product_id = $item->product_id;
                $item->user_id = Auth::id();
                $item->qty = $cartItem->qty;
                $item->save();
            }
        }

        return $item;
    }

    function update($id, $qty)
    {
        $item = $this->items[$id];
        $item["qty"] = $qty;
        if ($item->qty <= 0) {
            unset($this->items[$item["product_id"]]);
        } else {
            $cart[$id] = $item;
        }
        $this->set($item);
        if(Auth::check()){
            $item = ShopCartModel::where(["user_id"=>Auth::id(),"product_id"=>$id])->first();
            if($item){
                $item->qty += $qty;
                $item->save();
            } else{
                $item = new ShopCartModel();
                $item->product_id = $item->product_id;
                $item->user_id = Auth::id();
                $item->qty = $qty;
                $item->save();
            }
        }
        return $item;
    }

    function get($id)
    {
        return $this->items[$id] ?: "";
    }

    function set($item)
    {
        $this->items[$item["product_id"]] = $item;
        $this->session->put($this->instance, $this->items);
    }

    public function destroy()
    {
        $this->session->remove($this->instance);
    }
}