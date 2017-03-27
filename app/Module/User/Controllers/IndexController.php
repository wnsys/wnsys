<?php
namespace App\Module\User\Controllers;
use App\Module\Blog\Bll\BlogArticleBll;
use App\Module\Blog\Model\BlogArticleModel;
use App\Module\Web\Controllers\WebController;
use Illuminate\Support\Facades\Auth;

class IndexController extends WebController{
    public function home(){
        $bloglist = BlogArticleModel::where(["user_id"=>Auth::id()])->orderBy('id','desc')
            ->paginate(config("module.blog.page_size"));
        BlogArticleBll::stripDate($bloglist);
        return view("index.index",[
            "bloglist"=>$bloglist
        ]);
    }
}