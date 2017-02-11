<?php
namespace App\Module\Shop\Model;

use App\Model\CategoryModel;

class ShopCategoryModel extends CategoryModel
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->module = "shop";
    }

}
