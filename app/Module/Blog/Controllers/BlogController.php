<?php
namespace App\Module\Blog\Controllers;

use App\Http\Controllers\AdminController;
use App\Model\Blog\BlogArticleModel;
use App\Model\Blog\BlogCategoryModel;
use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/26 0026
 * Time: 11:36
 */
class BlogController extends AdminController
{
    function index()
    {
        $data = BlogArticleModel::all();
        $options = BlogCategoryModel::options();
        return view("blog.blog.list", [
            "data" => $data,
            'options' => $options
        ]);
    }

    function edit(Request $request)
    {
        $data = BlogArticleModel::where("id", $request["id"])->first();
        if ($request["dosubmit"]) {
            $data->update($request["info"]);
        }
        $options = BlogCategoryModel::options();
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
        $options = BlogCategoryModel::options();
        return view("blog.blog.add", [
            'options' => $options
        ]);
    }

    function delete()
    {

    }
}