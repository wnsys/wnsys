<?php
namespace App\Http\Module\Shop\Bll;
use App\Http\Module\Shop\Model\ShopCategoryModel;

class ShopCategoryBll extends \App\Core\Bll\CategoryBll
{
    public function __construct()
    {
        $this->module = "shop";
        $this->model = new ShopCategoryModel();
    }
}