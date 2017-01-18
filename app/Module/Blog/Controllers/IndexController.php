<?php
namespace App\Module\Blog\Controllers;
use App\Module\Blog\Bll\BlogArticleBll;
use App\Module\Blog\Bll\CategoryBll;
use App\Module\Blog\Model\BlogArticleModel;
use App\Module\Blog\Model\BlogCategoryModel;
use App\Module\Blog\Model\BlogImageModel;
use App\Module\Web\Controllers\WebController;
use Illuminate\Support\Facades\Response;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/26 0026
 * Time: 11:36
 */
class IndexController extends WebController
{
    function show($id)
    {
        $blog = BlogArticleModel::find($id);
        $breadcrumb = BlogArticleBll::breadcrumb($id);
        return view("web.show", [
            "blog" => $blog,
            "breadcrumb" => $breadcrumb
        ]);
    }
    function lists($id){
        $data = BlogArticleModel::lists($id);
        $breadcrumb = CategoryBll::breadcrumb($id,false);
        return view("web.index",[
            "bloglist"=>$data,
            "breadcrumb" => $breadcrumb
        ]);
    }
}