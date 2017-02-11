<?php
namespace App\Model;

use App\Model\Common\ParentModel;

class CategoryModel extends AppModel
{
    use ParentModel;
    protected $table = "category";
    public $module = "";
    protected $fillable = [
        'name', 'parentid', 'parentids',"template","module"
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
        $data["module"] = self::module;
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
