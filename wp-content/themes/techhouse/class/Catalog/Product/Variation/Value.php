<?php
class Catalog_Product_Variation_Value extends Model_Abstract
{
	protected function _construct()
	{
		$this->_init('variations_product', 'value_id');
	}
}