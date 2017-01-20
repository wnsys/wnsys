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
    static public function stripDate(&$bloglist){
        $dates = [];
        foreach ($bloglist as $k=>$blog){
            if($dates[$blog->created_at->toDateString()]){
                $bloglist[$k]->created_at = null;
            }else{
                $dates[$blog->created_at->toDateString()] = 1;
            }
        }

    }
   static function breadcrumb($id){
        $parents[] = ["url"=>"/","name"=>"首页","class"=>""];
        $blog = BlogArticleModel::find($id);
        $parents = $parents + BlogCategoryModel::parents($blog["catid"]);
        $breadcrumb = $parents;
        return $breadcrumb;
    }
}