<?php
namespace App\Module\Web\Controllers;
use App\Module\Blog\Bll\BlogArticleBll;
use App\Module\Blog\Model\BlogArticleModel;
use App\Module\Web\Bll\IndexBll;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic;
use NInterface\BlogInterface;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/23 0023
 * Time: 14:50
 */
class IndexController extends WebController{
   
    public function index(){
        $bloglist = BlogArticleModel::orderBy('id','desc')
            ->paginate(config("module.blog.page_size"));
        BlogArticleBll::stripDate($bloglist);
        return view("web.index",[
            "bloglist"=>$bloglist
        ]);
    }
}