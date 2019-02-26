<?php
namespace App\Http\Module\Shop\Model;

use App\Model\AppModel;

class ShopOrderDetailModel extends AppModel
{
    protected $table = "shop_order_detail";
    protected $fillable = [
        "order_id","product_id","qty"
    ];
    protected $hidden = [

    ];
    public function product(){
       return $this->hasOne(ShopProductModel::class,"id","product_id");
    }
    public function order(){
        return $this->belongsTo(ShopOrderModel::class);
    }
}
