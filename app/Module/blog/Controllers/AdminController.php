<?php
namespace App\Module\Blog\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Blog\BlogArticleModel;
use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/26 0026
 * Time: 11:36
 */
class AdminController extends Controller
{
    function index()
    {
        $data = BlogArticleModel::all();
        return view("blog.admin.list", [
            "data" => $data
        ]);
    }
    function editBlog(Request $request){
       

        return view("blog.admin.edit");
    }
    function addBlog(Request $request)
    {
        if ($request["dosubmit"]) {
            BlogArticleModel::create($request["info"]);
        }
        return view("blog.admin.add");
    }

}