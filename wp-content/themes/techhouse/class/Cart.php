<?php
if (!class_exists('Cart')) {
    class Cart extends Model
    {
        protected $_sessionId = null;

        protected static $_quote;

        protected function _construct()
        {
            $this->init('quote', 'quote_id');
        }

        public function getSessionId()
        {
            if (is_null($this->_sessionId)) {
                if (isset($_COOKIE['wp_cart_session_id']) && $_COOKIE['wp_cart_session_id'] != '') {
                    $this->_sessionId = $_COOKIE['wp_cart_session_id'];
                }
            }
            return $this->_sessionId;
        }

        public function getQuote()
        {
            if (!self::$_quote) {
                global $wpdb;
                $table = $this->getTableName();
                $sessionId = $this->getSessionId();
                $sql = "SELECT * FROM $table WHERE `session_id` = '$sessionId'";
                $result = $wpdb->get_row($sql, ARRAY_A);
                if (!$result) {
                    $result = $this->_addQuote();
                }
                self::$_quote = new Varien_Object($result);
            }
            return self::$_quote;
        }

        protected function _addQuote()
        {
            $data = array(
                'session_id' => $this->getSessionId(),
                'sub_total' => 0,
                'shipping_fee' => 0,
                'discount' => 0,
                'grand_total' => 0,
            );
            global $wpdb;
            $wpdb->insert($this->getTableName(), $data);
            $data[$this->getIdFieldName()] = $wpdb->insert_id;
            return $data;
        }

        public function getAllItems()
        {
            global $wpdb;
            $quoteId = $this->getQuote()->getQuoteId();
            $tableName = $wpdb->prefix . 'quote_item';
            $sql = "SELECT * FROM `$tableName` WHERE `quote_id` = $quoteId";
            return $wpdb->get_results($sql, ARRAY_A);
        }
    }
}