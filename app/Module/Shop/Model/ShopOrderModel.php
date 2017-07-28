<?php
namespace App\Module\Shop\Model;

use App\Model\AppModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShopOrderModel extends AppModel
{
    use SoftDeletes;
    protected $table = "shop_order";
    protected $fillable = [
        "user_id","user_name","phone","address","amount"
    ];
    protected $hidden = [

    ];
    public function detail(){
       return $this->hasMany(ShopOrderDetailModel::class,"order_id","id");
    }
}
