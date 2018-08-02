<?php
namespace App\Http\Module\Web\Controllers;
use App\Http\Module\Blog\Bll\BlogArticleBll;
use App\Http\Module\Blog\Model\BlogArticleModel;
use NInterface\BlogInterface;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/23 0023
 * Time: 14:50
 */
class IndexController extends WebController{
   
    public function index(){
        $bloglist =    BlogArticleModel::lists(0);
        BlogArticleBll::stripDate($bloglist);
        return view("web.index",[
            "bloglist"=>$bloglist
        ]);
    }
    function xiao(){

        return view("web.xiao");
    }
}