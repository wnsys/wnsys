<?php
/**
 * Created by wnsys.net
 * User: weining
 * Email: 178441367@qq.com
 * Date: 2017/1/19
 * Time: 20:27
 */
namespace App\Module\Web\Bll;
class IndexBll{
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
}