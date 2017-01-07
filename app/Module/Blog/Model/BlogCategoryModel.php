<?php
namespace App\Module\Blog\Model;

use App\Model\AppModel;

class BlogCategoryModel extends AppModel
{
    protected $table = "blog_category";
    protected $fillable = [
        'name', 'parentid', 'parentids',
    ];
    protected $hidden = [

    ];
    static function parents($catid,$self = true){
        $result = [];
        $rs = static::find($catid);
        $arr_parentids = explode(",",$rs["parentids"]);
        unset($arr_parentids[0]);
        if($self){
            $arr_parentids[] = $catid;
        }
        foreach ($arr_parentids as $cid){
            $result[$cid] = static::find($cid);
            $result[$cid]["url"] = "/blog/cat/$cid";
        }
        return $result;
    }
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
    static function createParentids($parentid){
        $parent = static::find($parentid);
        if ($parent) {
            $parentids = $parent->parentids . "," . $parentid;
        } else {
            $parentids = 0;
        }
        return $parentids;
    }
   static function modelSave($catid, $cat_name, $parentid)
    {
        $cat = static::find($catid);
        $cat->parentid = $parentid;
        $cat->parentids = static::createParentids($parentid);
        $cat->name = $cat_name;
        return $cat->save();
    }

}
