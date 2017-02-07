<?php
namespace App\Module\Blog\Bll;

use App\Module\Blog\Model\BlogCategoryModel;
use App\Core\Libs\Tree;

class CategoryBll
{
    static public function templates($controller,$contain){
        $result = [];
        $path = config("view.paths")[0];
        foreach (["pc","","wap"] as $device){
            $_path = $path."/".app()["module"]."/$device/$controller";
            $templates = app()["files"]->files($_path);
            if($templates)
                break;
        }
        $files = array_map("basename",$templates);
        foreach ($files as $file){
            if(strpos($file,$contain) !== false){
                $result[] = substr($file,0,strpos($file,"."));
            }
        }
        return $result;
    }
    static public function breadcrumb($id)
    {
        $cat = BlogCategoryModel::find($id);
        $parents[] = ["url" => "/", "name" => "首页", "class" => ""];
        $parents = $parents + BlogCategoryModel::parents($id, false);
        $parents[] = ["url" => "", "name" => $cat["name"], "class" => "active"];
        return $parents;
    }

    static public function formSelect($name = "", $selected = 0)
    {
        $select = "<select id='$name' name='$name' class='form-control'>";
        $options = BlogCategoryModel::options($selected);
        $select .= $options;
        $select .= "</select>";
        return $select;
    }

    static public function treeLists()
    {
        $str = "<tr>
                        <td>\$spacer\$name</td>
                        <td><span class='glyphicon glyphicon-pencil'></span>
                            <a data-id='\$id' class='edit' href='/admin/blog/category/edit/\$id' >编辑</a>
                            &nbsp;&nbsp;
                            <span class='glyphicon glyphicon-minus'></span>
                           <a href='/admin/blog/category/delete?id=\$id' onclick='return confirm(\\\"确定删除吗\\\")' >删除</a></td>
                 </tr>";

        $data = BlogCategoryModel::all()->toArray();
        foreach ($data as $item) {
            $result[$item["id"]] = $item;
        }
        $tree = new Tree();
        $tree->init($result);
        return $tree->get_tree(0, $str);
    }
}