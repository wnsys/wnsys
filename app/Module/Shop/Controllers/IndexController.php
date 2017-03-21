<?php
namespace App\Module\Shop\Controllers;

use App\Module\Shop\Bll\CartBll;
use App\Module\Shop\Bll\ShopCategoryBll;
use App\Module\Shop\Cart\Cart;
use App\Module\Shop\Cart\CartItem;
use App\Module\Shop\Model\ShopCartModel;
use App\Module\Shop\Model\ShopProductModel;
use App\Module\Web\Controllers\WebController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/26 0026
 * Time: 11:36
 */
class IndexController extends WebController
{
    function index(Request $request)
    {
        $query = new ShopProductModel();
        $data = $query->orderBy('id', 'desc')->paginate(10);
        return view("index.index", [
            "data" => $data,
        ]);
    }

    function show($id, Request $request)
    {
        $data = ShopProductModel::find($id);
        $breadcrumb = ShopCategoryBll::n()->breadcrumb($id);
        $cart = Cart::n()->items;
        return view("index.show", [
            "data" => $data,
            "breadcrumb" => $breadcrumb,
            "cart"=>$cart
        ]);
    }

    //添加到购物车
    function addCart(Request $request)
    {
        $this->validate($request,[
            "product_id" => "required",
            "price" => "required",
            "name" => "required",
            "qty" => "required",
        ]);
        $catItem = new CartItem($request->product_id,$request->name,$request->qty,$request->price,[]);
        $item = Cart::n()->add($catItem);
        $response = new Response($item);
        return $response;
    }
    public function getCart(){
        
    }
}