<?php
namespace App\Module\Web\Controllers;
use App\Http\Controllers\Controller;
use App\Model\Blog\BlogArticleModel;
use App\Model\Blog\BlogCategoryModel;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/23 0023
 * Time: 14:50
 */
class IndexController extends WebController{

    public function index(){
        $data = BlogArticleModel::orderBy('id','desc')->paginate(10);
        return view("web.index",[
            "bloglist"=>$data
        ]);
    }
}