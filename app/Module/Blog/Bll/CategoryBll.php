<?php
namespace App\Module\Blog\Bll;
use App\Module\Blog\Model\BlogCategoryModel;

class CategoryBll{
    static public function formSelect($name = "",$selected = 0){
        $select = "<select id='$name' name='$name' class='form-control'>";
        $options = BlogCategoryModel::options($selected);
        $select .=  $options;
        $select .= "</select>";
        return $select;
    }
}