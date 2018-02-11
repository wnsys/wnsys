<?php
namespace App\Module\Blog\Index\Controllers;
use App\Module\Blog\Bll\BlogArticleBll;
use App\Module\Blog\Bll\BlogCategoryBll;
use App\Module\Blog\Model\BlogArticleModel;
use App\Module\Blog\Model\BlogCategoryModel;
use App\Module\Web\Controllers\WebController;
use Illuminate\Support\Facades\Response;

class IndexController extends WebController
{
    function show($id)
    {
        $blog = BlogArticleModel::find($id);
        $breadcrumb = BlogArticleBll::breadcrumb($id);
        seo($blog->title);
        return view("blog.index.show", compact('blog','breadcrumb'));
    }
    function lists($id){
        $data = BlogArticleModel::lists($id);
        BlogArticleBll::stripDate($data);
        $cat = BlogCategoryModel::find($id);
        $template = $cat["template"];
        $breadcrumb = BlogCategoryBll::n()->breadcrumb($id);
        return view("blog.index.$template",[
            "bloglist"=>$data,
            "breadcrumb" => $breadcrumb
        ]);
    }
}