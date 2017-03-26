<?php
namespace App\Module\Shop\Model;

use App\Model\AppModel;

class ShopOrderModel extends AppModel
{
    protected $table = "shop_order_detail";
    protected $fillable = [
        "orderi_id","product_id,qty"
    ];
    protected $hidden = [

    ];
}
