<?php
namespace App\Core\Bll;

use App\Core\Framework\Object;
use App\Core\Libs\Tree;
use App\Model\CategoryModel;

class CategoryBll extends Object
{
    public $module;
    public $model ;
    public function templates($controller, $contain)
    {
        $result = [];
        $path = config("view.paths")[0];
        foreach (["pc", "", "wap"] as $device) {
            $_path = $path . "/" . app()["module"] . "/$device/$controller";
            $templates = app()["files"]->files($_path);
            if ($templates)
                break;
        }
        $files = array_map("basename", $templates);
        foreach ($files as $file) {
            if (strpos($file, $contain) !== false) {
                $result[] = substr($file, 0, strpos($file, "."));
            }
        }
        return $result;
    }

    public function breadcrumb($id)
    {
        $cat = CategoryModel::find($id);
        $parents[] = ["url" => "/", "name" => "首页", "class" => ""];
        $parents = $parents + $this->model->parents($id, false);
        $parents[] = ["url" => "", "name" => $cat["name"], "class" => "active"];
        return $parents;
    }

    public function formSelect($name = "", $selected = 0)
    {
        $select = "<select id='$name' name='$name' class='form-control'>";
        $options = $this->model->options($selected);
        $select .= $options;
        $select .= "</select>";
        return $select;
    }

    public function treeLists()
    {
        $str = "<tr>
                        <td>\$spacer\$name</td>
                        <td><span class='glyphicon glyphicon-pencil'></span>
                            <a data-id='\$id' class='edit' href='/admin/".$this->module."/category/edit/\$id' >编辑</a>
                            &nbsp;&nbsp;
                            <span class='glyphicon glyphicon-minus'></span>
                           <a href='/admin/".$this->module."/category/delete?id=\$id' onclick='return confirm(\\\"确定删除吗\\\")' >删除</a></td>
                 </tr>";

        $data = CategoryModel::where(["module" => $this->module])->get()->toArray();

        foreach ($data as $item) {
            $result[$item["id"]] = $item;
        }
        $tree = new Tree();
        $tree->init($result);
        return $tree->get_tree(0, $str);
    }
}