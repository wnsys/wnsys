<?php
namespace App\Module\Shop\Model;

use App\Model\AppModel;

class ShopCartModel extends AppModel
{
    public $name;//产品名称
    public $price;
    protected $table = "shop_cart";
    protected $fillable = [
        "product_id","user_id","qty"
    ];
    protected $hidden = [

    ];
    function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        if($attributes["product_id"]){
            $product = ShopProductModel::find($attributes["product_id"]);
            $this->name = $product->name;
            $this->price = $product->price;
        }

    }
}
