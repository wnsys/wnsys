<?php
namespace App\Module\User\Controllers;
use App\Http\Controllers\AdminController;
use App\Module\Blog\Bll\BlogArticleBll;
use App\Module\Blog\Model\BlogArticleModel;
use App\Module\Web\Controllers\WebController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class IndexController extends WebController{
    function __construct()
    {
        //todo 权限相关
        $this->middleware('auth');
        parent::__construct();
    }

    public function home(){
        $bloglist = BlogArticleModel::where(["user_id"=>Auth::id()])->orderBy('id','desc')
            ->paginate(config("module.blog.page_size"));
        BlogArticleBll::stripDate($bloglist);
        return view("index.index",[
            "bloglist"=>$bloglist
        ]);
    }
}