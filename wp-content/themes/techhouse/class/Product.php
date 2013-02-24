<?php
require_once 'Varien_Object.php';
class Product extends Varien_Object
{
    const PRICES_KEY = 'product_prices';

    const OPTIONS_KEY = 'product_options';

    const RELATED_KEY = 'product_related';

    protected $_idFieldName = 'ID';

    //protected $_optionsKey = 'product_options';

    protected $_options = array();

    protected function _construct()
    {

    }

    public function load($productId)
    {
        if (!empty($productId)) {
            $productData = get_post($productId, 'ARRAY_A');
            if ($productData) {
                $this->setData($productData);
                if ($this->getId()) {
                    //$metaData = get_post_meta($this->getId());
                    //$this->setMetaData($metaData);
                }
            }
        }
        return $this;
    }

    public function getOptions()
    {
        if (empty($this->_options)) {
            $this->_options = get_post_meta($this->getId(), self::OPTIONS_KEY, true);
        }
        return $this->_options;
    }

    public function getOption($key)
    {
        $productOptions = $this->getOptions();
        if (isset($productOptions[$key])) {
            return $productOptions[$key];
        }
        return null;
    }

    public function save()
    {
        $postData = $this->getData();
        if ($this->getId()) {
            wp_update_post($postData);
        } else {
            $productId = wp_insert_post($postData);
            $this->setId($productId);
        }
        //$this->_saveMetaData();
        return $this;
    }

    protected function _saveMetaData()
    {
        if ($this->getMetaData()) {
            foreach ($this->getMetaData() as $key => $value) {
                if (get_post_meta($this->getId(), $key, true) === false) {
                    add_post_meta($this->getId(), $key, $value);
                } else {
                    update_post_meta($this->getId(), $key, $value);
                }
            }
        }
    }

    public function getMetaData($metaKey = '')
    {
        return get_post_meta($this->getId(), $metaKey, true);
    }

    public function getFinalPrice()
    {
        $prices = $this->getMetaData(self::PRICES_KEY);
        if (isset($prices['default'])) {
            return $prices['default'];
        }
        return 0;
    }
}