<?php
namespace App\Module\Shop\Model;

use App\Model\AppModel;

class ShopOrderModel extends AppModel
{
    protected $table = "shop_order";
    protected $fillable = [
        "userid","productid"
    ];
    protected $hidden = [

    ];
}
