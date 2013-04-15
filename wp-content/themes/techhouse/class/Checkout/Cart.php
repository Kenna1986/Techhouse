<?php
class Checkout_Cart extends Model_Abstract
{
    protected $_hook = 'cart_';

    protected $_items = array();

    protected function _construct()
    {
        $this->_init('cart', 'cart_id');
    }

    public function getAllItems()
    {
        if (!$this->_items) {
            $item = new Checkout_Cart_Item();
            $itemTable = $item->getMainTable();
            $cartId = $this->getId();
            $sql = "SELECT * FROM `$itemTable` WHERE `$itemTable`.`cart_id` = $cartId";
            $result = $this->getAdapter()->get_results($sql, ARRAY_A);
            if ($result) {
                foreach ($result as $cartItem) {
                    $this->_items[] = $item->setData($cartItem);
                }
            }
        }
        return $this->_items;
    }
}