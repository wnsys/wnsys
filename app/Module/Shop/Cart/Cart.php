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

    function add(array  $cartItem)
    {
        $item = $this->items[$cartItem["product_id"]];
        if ($item) {
            $item["qty"] += $cartItem["qty"];
        } else {
            $item = $cartItem;
        }
        $this->set($item);
        if (Auth::check()) {
            $this->store($cartItem["product_id"], $cartItem["qty"]);
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

    function getItems()
    {
        if (Auth::check()) {
            $rs = ShopCartModel::where(["user_id" => Auth::id()])->get()->toArray();
            foreach ($rs as $item) {
                $items[$item["id"]] = $item;
                $product = ShopProductModel::find($item["id"]);
                $items[$item["id"]]["name"] = $product["name"];
                $items[$item["id"]]["price"] = $product["price"];
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

    function set($item)
    {
        $this->items[$item["product_id"]] = $item;
        $this->session->put($this->instance, $this->items);
    }

    public function destroy()
    {
        $this->session->remove($this->instance);
    }

    public function store($id, $qty)
    {
        $item = ShopCartModel::where(["user_id" => Auth::id(), "product_id" => $id])->first();
        if ($item) {
            $item->qty += $qty;
            $item->save();
        } else {
            $item = new ShopCartModel();
            $item->product_id = $id;
            $item->user_id = Auth::id();
            $item->qty = $qty;
            $item->save();
        }
    }
}