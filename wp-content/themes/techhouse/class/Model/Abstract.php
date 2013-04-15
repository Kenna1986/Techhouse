<?php
abstract class Model_Abstract extends Varien_Object
{
    protected $_mainTable;

    protected $_selectAttributes = array();

    protected static $_db;

    protected $_hook = 'model_';

    protected function _init($mainTable, $idFieldName)
    {
        $this->_mainTable = $this->getAdapter()->prefix . $mainTable;
        $this->_idFieldName = $idFieldName;
        return $this;
    }

    public function getSelectAttributes()
    {
        return $this->_selectAttributes;
    }

    public function addAttributeToSelect($attributes)
    {
        if (is_array($attributes)) {
            $this->_defaultAttributes = array_merge($this->_defaultAttributes, $attribute);
        } elseif(!in_array($attributes, $this->_selectAttributes)) {
            array_push($this->_selectAttributes, $attributes);
        }
    }

    public function load($mainId)
    {
        $select = $this->getSelecttAttributes() ? implode(',', $this->getSelecttAttributes()) : '*';
        $where = "$this->_idFieldName = '$mainId'";

        $sql = "SELECT $select
                    FROM $this->_mainTable
                    WHERE $where";
        $data = $this->getAdapter()->get_row($sql, ARRAY_A);
        $this->addData($data);
        do_action($this->_hook . 'after_load', $this);
        return $this;
    }

    public function save()
    {
        if ($this->getId()) {
            // do action
        } else {
            // do action
        }
        do_action($this->_hook . 'after_save', $this);
        return $this;
    }

    public function getAdapter()
    {
        if (!self::$_db) {
            global $wpdb;
            self::$_db = $wpdb;
        }
        return self::$_db;
    }

    public function getMainTable()
    {
        return $this->_mainTable;
    }
}