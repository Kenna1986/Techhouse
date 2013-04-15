<?php
class Checkout_Cart_Item extends Model_Abstract
{
    protected $_hook = 'cart_item';

    protected function _construct()
    {
        $this->_init('cart_item', 'item_id');
    }

    public function getOptions()
    {
        $options = parent::getOptions();
        return unserialize($options);
    }
}