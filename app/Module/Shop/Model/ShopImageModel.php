<?php
namespace App\Module\Shop\Model;

use App\Model\ImageModel;
use Illuminate\Support\Facades\Auth;

class ShopImageModel extends ImageModel
{
    public $module = "shop";
}