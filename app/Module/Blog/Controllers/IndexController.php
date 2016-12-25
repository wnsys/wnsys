<?php
namespace App\Module\Blog\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Blog\BlogArticleModel;
use App\Model\Blog\BlogCategoryModel;
use App\Model\TopicModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/26 0026
 * Time: 11:36
 */
class IndexController extends Controller
{
    function show($id)
    {
        $blog = BlogArticleModel::find($id);
        $blog_category = BlogCategoryModel::where("parentid", 0)->get();
        return view("blog.web.show", [
            "blog" => $blog,
            "blog_category" => $blog_category
        ]);
    }
}