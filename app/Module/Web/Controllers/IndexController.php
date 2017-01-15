<?php
namespace App\Module\Web\Controllers;
use App\Module\Blog\Model\BlogArticleModel;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/23 0023
 * Time: 14:50
 */
class IndexController extends WebController{

    public function index(){
        $data = BlogArticleModel::orderBy('id','desc')->paginate(16);
        return view("web.index",[
            "bloglist"=>$data
        ]);
    }
}