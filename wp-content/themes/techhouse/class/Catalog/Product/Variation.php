<?php
class Catalog_Product_Variation extends Model_Abstract
{
	protected function _construct()
	{
		$this->_init('variations', 'variation_id');
	}

	public function loadByCode($code)
	{
		$table = $this->getMainTable();
		$sql = "SELECT * FROM $table WHERE `code` = '$code'";
		$data = $this->getAdapter()->get_row($sql, ARRAY_A);
		$this->setData($data);
		return $this;
	}
}