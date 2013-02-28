<?php
abstract class Model extends Varien_Object
{
    protected $_tableName = '';

    public function init($name, $idFieldName)
    {
        global $wpdb;
        $this->_tableName = $wpdb->prefix . $name;
        $this->setIdFieldName($idFieldName);
    }

    public function getTableName()
    {
        return $this->_tableName;
    }
}