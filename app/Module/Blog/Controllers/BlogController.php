<?php
namespace App\Module\Blog\Controllers;
use App\Http\Controllers\AdminController;
use App\Model\Blog\BlogArticleModel;
use App\Model\Blog\BlogCategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends AdminController
{
    function __construct()
    {
        view()->share("options",BlogCategoryModel::options());
    }

    function index(Request $request)
    {
        $data = BlogArticleModel::orderBy('id','desc')->paginate(10);
        return view("blog.blog.list", [
            "data" => $data,
        ]);
    }

    function edit(Request $request)
    {
        $data = BlogArticleModel::where("id", $request["id"])->first();
        if ($request["dosubmit"]) {
            $data->update($request["info"]);
        }
        $options = BlogCategoryModel::options($data["catid"]);
        return view("blog.blog.add", [
            "data" => $data,
            'options' => $options
        ]);
    }

    function add(Request $request)
    {
        if ($request["dosubmit"]) {
            BlogArticleModel::create($request["info"]);
        }
        return view("blog.blog.add");
    }

    function delete(Request $request)
    {
       $rs =  BlogArticleModel::destroy($request["id"]);
        return redirect("/admin/blog");
    }
}