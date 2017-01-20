<?php
namespace App\Module\Web\Controllers;
use App\Module\Blog\Bll\BlogArticleBll;
use App\Module\Blog\Model\BlogArticleModel;
use App\Module\Web\Bll\IndexBll;
use Intervention\Image\ImageManagerStatic;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/23 0023
 * Time: 14:50
 */
class IndexController extends WebController{

    public function index(){
        $bloglist = BlogArticleModel::orderBy('id','desc')->paginate(config("module.blog.page_size"));
        BlogArticleBll::stripDate($bloglist);
        return view("index",[
            "bloglist"=>$bloglist
        ]);
    }
}