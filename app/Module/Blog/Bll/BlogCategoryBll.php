<?php
namespace App\Module\Blog\Bll;

use App\Module\Blog\Model\BlogCategoryModel;

class BlogCategoryBll extends \App\Core\Bll\CategoryBll
{

    public function __construct()
    {
        $this->module = "blog";
        $this->model = new BlogCategoryModel();
    }
}