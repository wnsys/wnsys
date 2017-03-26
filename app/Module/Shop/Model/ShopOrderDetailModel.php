<?php
namespace App\Module\Shop\Model;

use App\Model\AppModel;

class ShopOrderDetailModel extends AppModel
{
    protected $table = "shop_order_detail";
    protected $fillable = [
        "order_id","product_id","qty"
    ];
    protected $hidden = [

    ];
}
