<?php
abstract class Model
{
    protected $_tableName = '';

    protected $_idFieldName;

    public function init($name, $idFieldName)
    {
        global $wpdb;
        $this->_tableName = $wpdb->prefix . $name;
        $this->_idFieldName = $idFieldName;
    }

    public function getTableName()
    {
        return $this->_tableName;
    }

    public function getIdFieldName()
    {
        if (!$this->_idFieldName) {
            $this->_idFieldName = 'id';
        }
        return $this->_idFieldName;
    }
}