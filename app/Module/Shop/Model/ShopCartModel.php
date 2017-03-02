<?php
namespace App\Module\Shop\Model;

use App\Model\AppModel;

class ShopCartModel extends AppModel
{
    protected $table = "shop_cart";
    protected $fillable = [
        "product_id","sku_id","user_id","count"
    ];
    protected $hidden = [

    ];
}
