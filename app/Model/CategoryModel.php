<?php
namespace App\Model;

use App\Core\Libs\Tree;
use App\Model\Common\ParentModel;

class CategoryModel extends AppModel
{
    protected $table = "category";
    static $module = "blog";
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
        $data["module"] = static::$module;
        return static::create($data);
    }
   
   static function modelSave($catid, $info)
    {
        $cat = static::find($catid);
        $info["parentids"] = static::createParentids($info["parentid"]);
        $cat->attributes = $info;
        return $cat->save();
    }
    static function parents($id,$self = true){
        $result = [];
        $rs = static::find($id);
        $arr_parentids = explode(",",$rs["parentids"]);
        unset($arr_parentids[0]);
        if($self){
            $arr_parentids[] = $id;
        }
        foreach ($arr_parentids as $cid){
            $result[$cid] = static::find($cid);
            $result[$cid]["url"] = "/blog/cat/$cid";
        }
        return $result;
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
    static function options($selected = 0){
        $data = static::where(["module"=>static::$module])->get()->toArray();
        $result = [];
        foreach ($data as $item){
            $result[$item["id"]] = $item;
        }
        $first = ' <option value="0">未选择</option>';
        $str = "<option value=\$id \$selected>\$spacer\$name</option>";
        $tree = new Tree();
        $tree->init($result);
        return $first.$tree->get_tree(0,$str,$selected);
    }
}
