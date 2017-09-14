<?php
namespace App\Module\Blog\Model;

use App\Model\CategoryModel;

class BlogCategoryModel extends CategoryModel
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->module = "blog";
    }

}
