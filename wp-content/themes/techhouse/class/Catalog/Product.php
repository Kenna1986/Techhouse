<?php
class Catalog_Product extends Model_Abstract
{
    private $_variations = array();

    protected $_hook = 'product_';

    protected function _construct()
    {
        $this->_init('posts', 'ID');
        add_action('product_load_after', array($this, '_loadVariations'));
    }

    public function getVariations()
    {
        return $this->_variations;
    }

    private function _loadVariations($product)
    {
        $productId = $product->getId();
        $mainTable = $this->getAdapter()->prefix . 'product_variations';
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