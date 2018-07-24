<?php
namespace App\Http\Module\Blog\Index\Controllers;
use App\Http\Module\Blog\Bll\BlogArticleBll;
use App\Http\Module\Blog\Bll\BlogCategoryBll;
use App\Http\Module\Blog\Model\BlogArticleModel;
use App\Http\Module\Blog\Model\BlogCategoryModel;
use App\Http\Module\Web\Controllers\WebController;
use NInterface\BlogInterface;

class IndexController extends WebController
{
    /**
     * @var BlogInterface
     */
    public $blogInterface;
    function show($id)
    {
        $this->blogInterface->getList();
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