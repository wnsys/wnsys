<?php
namespace App\Http\Module\Blog\Bll;

use App\Http\Module\Blog\Model\BlogCategoryModel;

class BlogCategoryBll extends \App\Core\Bll\CategoryBll
{

    public function __construct()
    {
        $this->module = "blog";
        $this->model = new BlogCategoryModel();
    }
}