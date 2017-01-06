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
