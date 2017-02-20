<?php
namespace App\Module\Shop\Bll;
use App\Module\Shop\Model\ShopCategoryModel;

class ShopCategoryBll extends \App\Core\Bll\CategoryBll
{
    public function __construct()
    {
        $this->module = "shop";
        $this->model = new ShopCategoryModel();
    }
}