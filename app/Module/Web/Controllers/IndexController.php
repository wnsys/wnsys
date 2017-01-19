<?php
namespace App\Module\Web\Controllers;
use App\Module\Blog\Model\BlogArticleModel;
use Intervention\Image\ImageManagerStatic;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/23 0023
 * Time: 14:50
 */
class IndexController extends WebController{

    public function index(){
        ImageManagerStatic::make("a3.jpg")->resize(300, 200)->save("test.jpg");
        $data = BlogArticleModel::orderBy('id','desc')->paginate(16);
        return view("web.index",[
            "bloglist"=>$data
        ]);
    }
}