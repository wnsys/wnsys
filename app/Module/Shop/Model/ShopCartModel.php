<?php
namespace App\Module\Shop\Model;

use App\Model\AppModel;

class ShopCartModel extends AppModel
{
    protected $table = "shop_cart";
    protected $fillable = [
        "product_id","user_id","qty","name","price"
    ];
    protected $hidden = [

    ];
    function amount(){
        return $this->price * $this->qty;
    }
}
