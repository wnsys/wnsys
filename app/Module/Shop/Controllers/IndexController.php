<?php
namespace App\Module\Shop\Controllers;

use App\Module\Shop\Bll\CartBll;
use App\Module\Shop\Bll\ShopCategoryBll;
use App\Module\Shop\Model\ShopCartModel;
use App\Module\Shop\Model\ShopProductModel;
use App\Module\Web\Controllers\WebController;
use Gloudemans\Shoppingcart\Facades\Cart;
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
            "id" => "required",
            "price" => "required",
            "name" => "required",
        ]);
        $item = Cart::add($request->id,$request->name,$request->qty,$request->price,[]);
        print_r($item->toArray());
        $response = new Response($item->toArray());
        return $response;
    }
    public function getCart(){
        
    }
}