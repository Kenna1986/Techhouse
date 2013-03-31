<?php
class Catalog_Product extends Model_Abstract
{
    private $_options;

    protected function _construct()
    {
        $this->_init('posts', 'ID');
    }

    public function getOptions()
    {
        if (!$this->_options) {
            $prefix = $this->getAdapter()->prefix;
            $productAttribute = $prefix . 'product_attribute';
            $attribute = $prefix . 'attribute';
            $attributeValue = $prefix . 'attribute_value';
            $sql = "SELECT * FROM `$productAttribute`
                    LEFT JOIN `$attributeValue` ON `$productAttribute`.`value` = `$attributeValue`.`value_id`
                    WHERE";
        }
    }
}