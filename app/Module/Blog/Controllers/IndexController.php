<?php
namespace App\Module\Blog\Controllers;
use App\Module\Blog\Bll\BlogArticleBll;
use App\Module\Blog\Bll\BlogCategoryBll;
use App\Module\Blog\Bll\CategoryBll;
use App\Module\Blog\Model\BlogArticleModel;
use App\Module\Blog\Model\BlogCategoryModel;
use App\Module\Blog\Model\BlogImageModel;
use App\Module\Web\Bll\IndexBll;
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
        return view("index.show", [
            "blog" => $blog,
            "breadcrumb" => $breadcrumb,
        ]);
    }
    function lists($id){
        $data = BlogArticleModel::lists($id);
        BlogArticleBll::stripDate($data);
        $cat = BlogCategoryModel::find($id);
        $template = $cat["template"]?:"list";
        $breadcrumb = BlogCategoryBll::n()->breadcrumb($id);
        return view("index.$template",[
            "bloglist"=>$data,
            "breadcrumb" => $breadcrumb
        ]);
    }
}