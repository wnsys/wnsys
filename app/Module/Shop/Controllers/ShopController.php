<?php
namespace App\Module\Shop\Controllers;
use App\Core\Libs\Uploader;
use App\Model\ImageModel;
use App\Module\Blog\Model\BlogArticleModel;
use App\Module\Blog\Model\BlogCategoryModel;
use App\Module\Blog\Model\BlogImageModel;
use App\Module\Shop\Bll\ShopCategoryBll;
use App\Module\Shop\Model\ShopCategoryModel;
use App\Module\Shop\Model\ShopProductModel;
use App\Module\Teacher\Controllers\AdminController;
use App\Module\Web\Controllers\WebController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/26 0026
 * Time: 11:36
 */
class ShopController extends AdminController
{
    function __construct()
    {
        parent::__construct();
        view()->share("options", ShopCategoryModel::options());
    }

    function upload()
    {
        $upload = new Uploader("file");
        $info = $upload->getFileInfo();
        $info["user_id"] = Auth::id();
        $image = ImageModel::create($info);
        $info["image_id"] = $image->id;
        echo json_encode($info);
    }

    function index(Request $request)
    {
        $query = new ShopProductModel();
        if ($catid = $request["catid"]) {
            $query = $query->where("catid", $catid);
        }
        $catlist = ShopCategoryBll::formSelect("catid",$_GET["catid"]);
        $data = $query->orderBy('id', 'desc')->paginate(10);
        return view("shop.list", [
            "data" => $data,
            "catlist" => $catlist
        ]);
    }

    function edit(Request $request)
    {
        $data = ShopProductModel::where("id", $request["id"])->first();
        if ($request["dosubmit"]) {
            $data->modelSave($request["info"]);
            $add_ids = $request["info"]["attach_add"];
            $del_ids = $request["info"]["attach_del"];
            if ($add_ids  || $del_ids ) {
                BlogImageModel::model()->modelSave($request["id"],$add_ids, $del_ids);
            }
            return redirect("/admin/blog");
        }
        $options = BlogCategoryModel::options($data["catid"]);
        return view("shop.add", [
            "data" => $data,
            'options' => $options
        ]);

    }

    function add(Request $request)
    {
        if ($request["dosubmit"]) {
            $newid = (new ShopProductModel())->modelSave($request);
            if ($add_ids = $request["info"]["attach_add"]) {
                BlogImageModel::model()->modelSave($newid,$add_ids);
            }
            return redirect("/admin/blog");
        }
        return view("shop.add");
    }

    function delete(Request $request)
    {
        $rs = BlogArticleModel::destroy($request["id"]);
        return redirect("/admin/blog");
    }
}