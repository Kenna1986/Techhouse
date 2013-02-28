<?php
class Quote_Item extends Model
{
    private $_product;

    protected function _construct()
    {
        $this->init('quote_item', 'item_id');
    }

    public function getProduct()
    {
        if ($this->_product) {
            $this->_product = new Varien_Object();
            $productId = $this->getProductId();
            if ($productId) {
                global $wpdb;
                $sql = "SELECT * FROM $wpdb->posts WHERE `ID` = $productId";
                $result = $wpdb->get_row($sql, ARRAY_A);
                if ($result) {
                    $result['id'] = $result['ID'];
                    unset($result['ID']);
                    $this->_product->setData($result);
                }
            }
        }
        return $this->_product;
    }
}