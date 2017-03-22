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
        return view("index.show", [
            "data" => $data,
            "breadcrumb" => $breadcrumb,
        ]);
    }

    //添加到购物车
    function addCart(Request $request)
    {
        $this->validate($request,[
            "cart.product_id" => "required",
            "cart.price" => "required",
            "cart.name" => "required",
            "cart.qty" => "required",
        ]);

        $items = Cart::n()->add(new ShopCartModel($request["cart"]));
        $response = new Response($items);
        return $response;
    }
    public function getCart(){
        $response = new Response(Cart::n()->items);
        return $response;
    }
   
}