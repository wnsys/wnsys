<?php
namespace App\Http\Module\Shop\Model;

use App\Model\AppModel;

class ShopCartModel extends AppModel
{
    protected $table = "shop_cart";
    protected $fillable = [
        "product_id","user_id","qty","name","price","amount"
    ];
    protected $hidden = [

    ];
    function amount(){
        $this->amount = $this->price * $this->qty;
        return $this->amount;
    }
}
