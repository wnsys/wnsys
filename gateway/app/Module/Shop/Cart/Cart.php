<?php
namespace App\Module\Shop\Cart;

use App\Core\Framework\Object;
use App\Module\Shop\Model\ShopCartModel;
use App\Module\Shop\Model\ShopProductModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class Cart extends Object
{
    private $instance = "cart.default";
    private $session;
    public $items;

    function __construct()
    {
        $this->session = app("session");
        $this->items = $this->getItems();
    }

    function add(ShopCartModel $newItem)
    {
        $item = $this->get($newItem["product_id"]);
        if ($item) {
            $item["qty"] += $newItem["qty"];

        } else {
            $item = $newItem;
        }
        $this->set($item);
        return $this;
    }
    function getItems()
    {
        if (Auth::check()) {
            $rs = ShopCartModel::where(["user_id" => Auth::id()])->get();
            foreach ($rs as $item) {
                $items[$item["product_id"]] = $item->toArray();
            }
        } else {
            $items = $this->session->has($this->instance)
                ? $this->session->get($this->instance)
                : [];
        }
        return $items;
    }

    function get($id)
    {
        $item = $this->items[$id];
        $item = $item?new ShopCartModel($item):[];
        return $item;
    }
    function sum(){
        $sum = 0;
        foreach ($this->items as $item){
            $sum += $item["amount"];
        }
        return $sum;
    }
    function set(ShopCartModel $item)
    {
        if($item["qty"] <= 0){
            unset($this->items[$item["product_id"]]);
        }else{
            $item->amount();
            $this->items[$item["product_id"]] = $item->toArray();
        }
        $this->session->put($this->instance, $this->items);
        if (Auth::check()) {
            $this->store($item);
        }
    }

    public function destroy()
    {
        $this->session->remove($this->instance);
    }

    public function store(ShopCartModel $cartItem)
    {
        $item = ShopCartModel::where(["user_id" => Auth::id(), "product_id" => $cartItem["product_id"]])->first();
        if ($item) {
            if($cartItem["qty"] <= 0){
                $item->delete();
            }else{
                $item->qty = $cartItem["qty"];
                $item->amount();
                $item->save();
            }
        } else {
            $cartItem->user_id = Auth::id();
            $cartItem->save();
        }
    }
}