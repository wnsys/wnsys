<?php
namespace App\Module\Blog\Controllers;

use App\Core\Libs\Uploader;
use App\Http\Controllers\AdminController;
use App\Module\Blog\Bll\CategoryBll;
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
        view()->share("options", BlogCategoryModel::options());
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
        $data = $query->orderBy('id', 'desc')->paginate(10);
        return view("blog.blog.list", [
            "data" => $data,
        ]);
    }

    function edit(Request $request)
    {
        $data = BlogArticleModel::where("id", $request["id"])->first();
        if ($request["dosubmit"]) {
            $data->update($request["info"]);
            $add_ids = $request["info"]["attach_add"];
            $del_ids = $request["info"]["attach_del"];
            if ($add_ids  || $del_ids ) {
                BlogImageModel::model()->modelSave($request["id"],$add_ids, $del_ids);
            }
        }
        $options = CategoryBll::options($data["catid"]);
        return view("blog.blog.add", [
            "data" => $data,
            'options' => $options
        ]);
        
    }

    function add(Request $request)
    {
        if ($request["dosubmit"]) {
            BlogArticleModel::create($request["info"]);
            if ($image_ids = $request["info"]["attach"]) {
                $ids = explode(",", $image_ids);
                BlogImageModel::model()->modelSave($ids, $request["id"]);
            }
        }
        return view("blog.blog.add");
    }

    function delete(Request $request)
    {
        $rs = BlogArticleModel::destroy($request["id"]);
        return redirect("/admin/blog");
    }
}