<?php
namespace App\Module\Blog\Controllers;

use App\Core\Libs\Uploader;
use App\Http\Controllers\AdminController;
use App\Module\Blog\Bll\BlogCategoryBll;
use App\Module\Blog\Model\BlogArticleModel;
use App\Module\Blog\Model\BlogCategoryModel;
use App\Module\Blog\Model\BlogImageModel;
use App\Model\ImageModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BlogController extends AdminController
{
    function __construct()
    {
        parent::__construct();
        view()->share("options", BlogCategoryModel::n()->options());
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
        $query = new BlogArticleModel();
        if ($catid = $request["catid"]) {
            $query = $query->where("catid", $catid);
        }
        $catlist = BlogCategoryBll::n()->formSelect("catid",$_GET["catid"]);
        $data = $query->orderBy('id', 'desc')->paginate(10);
        return view("blog.list", [
            "data" => $data,
            "catlist" => $catlist
        ]);
    }

    function edit(Request $request)
    {
        $data = BlogArticleModel::where("id", $request["id"])->first();
        if ($request["dosubmit"] && $info = $request["info"]) {
            $data->modelSave($info);
            ImageModel::n()->modelSave($request,"blog","article");
            return redirect("/admin/blog");
        }
        $options = BlogCategoryModel::n()->options($data["catid"]);
        return view("blog.add", [
            "data" => $data,
            'options' => $options
        ]);
        
    }

    function add(Request $request)
    {
        if ($request["dosubmit"]) {
            $blog = BlogArticleModel::n()->modelSave($request["info"]);
            $request["id"] = $blog["id"];
            if ($add_ids = $request["attach_add"]) {
                ImageModel::n()->modelSave($request,"blog","article");
            }
            return redirect("/admin/blog");
        }
        return view("blog.add");
    }

    function delete(Request $request)
    {
        $rs = BlogArticleModel::destroy($request["id"]);
        return redirect("/admin/blog");
    }
}