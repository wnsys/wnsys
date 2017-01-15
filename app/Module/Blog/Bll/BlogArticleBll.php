<?php
namespace App\Module\Blog\Bll;
use App\Module\Blog\Model\BlogArticleModel;
use App\Module\Blog\Model\BlogCategoryModel;

/**
 * Created by wnsys.net
 * User: weining
 * Email: 178441367@qq.com
 * Date: 2017/1/7
 * Time: 8:13
 */
class BlogArticleBll{
   static function breadcrumb($id){
        $parents[] = ["url"=>"/","name"=>"首页","class"=>""];
        $blog = BlogArticleModel::find($id);
        $parents = $parents + BlogCategoryModel::parents($blog["catid"]);
        $parents[] = ["url"=>"","name"=>$blog["title"],"class"=>"active"];
        $breadcrumb = $parents;
        return $breadcrumb;
    }
}