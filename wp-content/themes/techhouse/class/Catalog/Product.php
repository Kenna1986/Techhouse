<?php
class Catalog_Product extends Model_Abstract
{
    private $_variations = array();

    protected $_hook = 'product_';

    protected function _construct()
    {
        $this->_init('posts', 'ID');
        add_action('product_after_load', array($this, 'initVariations'));
    }

    public function getVariations()
    {
        return $this->_variations;
    }

    public function initVariations($product = null)
    {
        if (!$this->_variations) {
            $productId = $product ? $product->getId() : $this->getId();
            if ($productId) {
                $mainTable = $this->getAdapter()->prefix . 'variations_product';
                $vTable = $this->getAdapter()->prefix . 'variations';

                $sql = "SELECT $mainTable.*, `$vTable`.`name`, `$vTable`.`code`
                            FROM $mainTable
                            LEFT JOIN $vTable ON `$vTable`.`variation_id` = `$mainTable`.`variation_id`
                            WHERE `product_id` = '$productId'";
                $result = $this->getAdapter()->get_results($sql);
                if ($result) {
                    foreach ($result as $row) {
                        if (!isset($this->_variations[$row->code])) {
                            $this->_variations[$row->code]['name'] = $row->name;
                        }
                        $this->_variations[$row->code]['values'][$row->value_id] = $row->value;
                    }
                }
            }
        }
        return $this;
    }
}