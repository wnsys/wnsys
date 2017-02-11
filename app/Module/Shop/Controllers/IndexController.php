<?php
namespace App\Module\Shop\Controllers;
use App\Module\Shop\Bll\ShopCategoryBll;
use App\Module\Shop\Model\ShopProductModel;
use App\Module\Web\Controllers\WebController;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/26 0026
 * Time: 11:36
 */
class IndexController extends WebController
{
    function index(Request $request){
        $query = new ShopProductModel();
        if ($catid = $request["catid"]) {
            $query = $query->where("catid", $catid);
        }
        $catlist = ShopCategoryBll::formSelect("catid",$_GET["catid"]);
        $data = $query->orderBy('id', 'desc')->paginate(10);
        return view("blog.list", [
            "data" => $data,
            "catlist" => $catlist
        ]);
    }
    function show($id)
    {
        
    }
}