<?php
namespace App\Module\Shop\Cart;
/**
 * Created by wnsys.net
 * User: weining
 * Email: 178441367@qq.com
 * Date: 2017/3/2
 * Time: 20:59
 */
class Cart extends \Gloudemans\Shoppingcart\Cart
{
    /**
     * Create a new CartItem from the supplied attributes.
     *
     * @param mixed     $id
     * @param mixed     $name
     * @param int|float $qty
     * @param float     $price
     * @param array     $options
     * @return \Gloudemans\Shoppingcart\CartItem
     */
    public function createCartItem($id, $name, $qty, $price, array $options)
    {
        if (is_array($id)) {
            $cartItem = CartItem::fromArray($id);
            $cartItem->setQuantity($id['qty']);
        } else {
            $cartItem = CartItem::fromAttributes($id, $name, $price, $options);
            $cartItem->setQuantity($qty);
        }

        return $cartItem;
    }
}