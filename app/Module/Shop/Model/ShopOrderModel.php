<?php
namespace App\Module\Shop\Model;

use App\Model\AppModel;

class ShopOrderModel extends AppModel
{
    protected $table = "shop_order";
    protected $fillable = [
        "user_id","user_name","phone","address","amount"
    ];
    protected $hidden = [

    ];
    public function detail(){
        $this->hasOne(ShopOrderDetailModel::class,"order_id","id");
    }
}
