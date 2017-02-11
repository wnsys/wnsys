<?php
namespace App\Module\Shop\Model;

use App\Model\AppModel;

class ShopProductModel extends AppModel
{
    protected $table = "shop_product";
    protected $fillable = [
        "name","content","catid","price"
    ];
    protected $hidden = [

    ];
}
