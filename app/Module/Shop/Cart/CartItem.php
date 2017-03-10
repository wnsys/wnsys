<?php
namespace App\Module\Shop\Cart;

use App\Core\Framework\Object;

class CartItem extends Object
{
    public $id;//产品id
    public $name;//产品名称
    public $qty;//数量
    public $options;//选项
    public $userid;//用户id
    function __construct($id,$name,$qty,$options = [],$userid = 0)
    {
        $this->id = $id;
        $this->name = $name;
        $this->qty = $qty;
        $this->options = $options;
        $this->userid = $userid;
        $this->rowId = $this->generateRowId($id, $options);
    }
    protected function generateRowId($id, array $options)
    {
        ksort($options);
        return md5($id . serialize($options));
    }
}