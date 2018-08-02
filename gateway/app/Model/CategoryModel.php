<?php
namespace App\Model;

use App\Core\Libs\Tree;

class CategoryModel extends AppModel
{
    protected $table = "category";
    public $module = "blog";
    protected $fillable = [
        'name', 'parentid', 'parentids',"template","module"
    ];
    protected $hidden = [

    ];

    /**
     * @param $catid
     * @param int $show 排除隐藏的栏目 0全部显示1只显示显示的
     * @return array
     */
    public function subIds($catid = 0,$show = 0){
        $cats = static::all();
        $result = [$catid];
        foreach ($cats as $cat){
            if($show == 1 && $cat["show"] == 0){
                continue;
            }
            if(in_array($catid,explode(",",$cat["parentids"]))  ){
                $result[] = $cat["id"];
            }
        }
        return $result;
    }
    public function modelCreate($data){
        $data["parentids"] = $this->createParentids($data["parentid"]);
        $data["module"] = $this->module;
        return static::create($data);
    }

    public function mySave($catid, $info)
    {
        $cat = static::find($catid);
        $info["parentids"] = $this->createParentids($info["parentid"]);
        $cat->attributes = $info;
        return $cat->save();
    }
    public function parents($id,$self = true){
        $result = [];
        $rs = static::find($id);
        $arr_parentids = explode(",",$rs["parentids"]);
        unset($arr_parentids[0]);
        if($self){
            $arr_parentids[] = $id;
        }
        foreach ($arr_parentids as $cid){
            $result[$cid] = static::find($cid);
            $result[$cid]["url"] = "/$this->module/cat/$cid";
        }
        return $result;
    }
    public function createParentids($parentid){
        $parent = static::find($parentid);
        if ($parent) {
            $parentids = $parent->parentids . "," . $parentid;
        } else {
            $parentids = 0;
        }
        return $parentids;
    }
    public function options($selected = 0){
        $data = static::where(["module"=>$this->module])->get()->toArray();
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
