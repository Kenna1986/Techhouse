<?php
abstract class Model_Abstract extends Varien_Object
{
    protected $_mainTable;

    protected $_defaultAttributes = array();

    protected $_db;

    protected $_filterKey = 'model_';

    protected function _init($mainTable, $idFieldName)
    {
        $this->_mainTable = $this->getAdapter()->prefix . $mainTable;
        $this->_idFieldName = $idFieldName;
        return $this;
    }

    public function getDefaultAttributes()
    {
        return $this->_defaultAttributes;
    }

    public function addAttribute($attribute)
    {
        if (is_array($attribute)) {
            $this->_defaultAttributes = array_merge($this->_defaultAttributes, $attribute);
        } elseif(!in_array($attribute, $this->_defaultAttributes)) {
            array_push($this->_defaultAttributes, $attribute);
        }
    }

    public function load($id)
    {
        $select = apply_filters($this->_filterKey . 'load_select', implode(',', $this->getDefaultAttributes()));
        $join = apply_filters($this->_filterKey . 'load_join', '');
        $where = apply_filters($this->_filterKey . 'load_where', "($this->_idFieldName = '$id')");
        $groupby = apply_filters($this->_filterKey . 'load_groupby', '');
        $orderby = apply_filters($this->_filterKey . 'load_orderby', '');

        $sql = "SELECT $select FROM $this->_mainTable
                $join
                WHERE $where
                $groupby";
        $data = $this->getAdapter()->get_row($sql, ARRAY_A);
        $this->addData($data)->_addFullNames();
        return $this;
    }

    public function getAdapter()
    {
        if (!$this->_db) {
            global $wpdb;
            $this->_db = $wpdb;
        }
        return $this->_db;
    }
}