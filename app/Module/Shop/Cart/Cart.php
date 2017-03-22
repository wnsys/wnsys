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
        $item = $this->items[$newItem["product_id"]];
        if ($item) {
            $item["qty"] += $newItem["qty"];
        } else {
            $item = $newItem;
        }
        $this->set($item);
        if (Auth::check()) {
            $this->store($item);
        }

        return $this->items;
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
        if (Auth::check()) {
            $this->store($id, $qty);
        }
        return $item;
    }

    function getItems($from="model")
    {
        if (Auth::check() && $from == "model") {
            $rs = ShopCartModel::where(["user_id" => Auth::id()])->get();
            foreach ($rs as $item) {
                $items[$item["id"]] = $item;
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
        $result = $this->items[$id];
        return $result;
    }

    function set(ShopCartModel $item)
    {
        $item->amount();
        $this->items[$item["product_id"]] = $item;
        $this->session->put($this->instance, $this->items);
    }

    public function destroy()
    {
        $this->session->remove($this->instance);
    }

    public function store(ShopCartModel $cartItem)
    {
        $item = ShopCartModel::where(["user_id" => Auth::id(), "product_id" => $cartItem["product_id"]])->first();
        if ($item) {
            $item->qty += $cartItem["qty"];
            $item->amount();
            $item->save();
        } else {
            $cartItem->user_id = Auth::id();
            $cartItem->amount();
            $cartItem->save();
        }
    }
}