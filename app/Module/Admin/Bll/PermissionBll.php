<?php
namespace App\Module\Admin\Bll;
use App\Core\Libs\Tree;
use App\Model\PermissionModel;

class PermissionBll{
   static function options($selected = 0){
       $data = PermissionModel::all()->toArray();
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