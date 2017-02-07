<?php
namespace App\Module\Blog\Model;

use App\Model\AppModel;
use App\Model\Common\ParentModel;

class BlogCategoryModel extends AppModel
{
    use ParentModel;
    protected $table = "blog_category";
    protected $fillable = [
        'name', 'parentid', 'parentids',"template"
    ];
    protected $hidden = [

    ];

    static function subIds($catid){
        $cats = static::all();
        $result = [$catid];
        foreach ($cats as $cat){
            if(in_array($catid,explode(",",$cat["parentids"]))){
                $result[] = $cat["id"];
            }
        }
        return $result;
    }
    static function modelCreate($data){
        $data["parentids"] = static::createParentids($data["parentid"]);
        return static::create($data);
    }
   
   static function modelSave($catid, $info)
    {
        $cat = static::find($catid);
        $info["parentids"] = static::createParentids($info["parentid"]);
        $cat->attributes = $info;
        return $cat->save();
    }

}
