<?php
namespace App\Model\Common;


use App\Core\Libs\Tree;

trait ParentModel
{
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
        $data = static::all()->toArray();
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
