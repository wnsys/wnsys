<?php
namespace App\Module\User\Index\Controllers;
use App\Http\Controllers\AdminController;
use App\Model\ImageModel;
use App\Module\Blog\Bll\BlogArticleBll;
use App\Module\Blog\Model\BlogArticleModel;
use App\Module\Web\Controllers\WebController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends UserController{
    public function add(Request $request){
        if ($request["dosubmit"]) {
            $blog = BlogArticleModel::n()->mySave($request["info"]);
            if ($add_ids = $request["imgs"]["add"]) {
                ImageModel::n()->mySave($blog["id"],$request["imgs"],"blog","article");
            }
            return redirect("/user/blog/add");
        }
        return view("blog.add");
    }
}