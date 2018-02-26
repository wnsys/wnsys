<?php
namespace App\Http\Module\Web\Controllers;
use App\Http\Module\Blog\Bll\BlogArticleBll;
use App\Http\Module\Blog\Model\BlogArticleModel;

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