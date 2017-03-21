<?php
namespace App\Module\Shop\Cart;

use App\Core\Framework\Object;
use App\Module\Shop\Model\ShopProductModel;

class CartItem extends Object
{
    public $product_id;//产品id
    public $name;//产品名称
    public $price;
    public $qty;//数量
    public $options;//选项
    public $user_id;//用户id
    function __construct($id,$qty,$options = [],$userid = 0)
    {
        $product = ShopProductModel::find($id);
        $this->product_id = $id;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->qty = $qty;
        $this->options = $options;
        $this->user_id = $userid;
    }
    protected function generateRowId($id, array $options)
    {
        ksort($options);
        return md5($id . serialize($options));
    }
    public function toArray()
    {
        return [
            'product_id' => $this->product_id,
            'name'     => $this->name,
            'qty'      => $this->qty,
            'price'    => $this->price,
            'options'  => $this->options,
        ];
    }
}