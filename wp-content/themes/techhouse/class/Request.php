<?php
if (!class_exists('Request')) {
    class Request
    {
        protected static $_baseUrl;

        public static function getBaseUrl()
        {
            if (!self::$_baseUrl) {
                self::$_baseUrl = get_bloginfo('url');
            }
            return self::$_baseUrl;
        }

        public static function getParam($key, $default = null)
        {
            if (isset($_REQUEST[$key])) {
                return $_REQUEST[$key];
            }
            return $default;
        }

        public static function getParams()
        {
            if ($_REQUEST) {
                return $_REQUEST;
            }
            return array();
        }

        public static function redirect($path, $params = array(), $https = false)
        {
            //ob_clean();
            $baseUrl = self::getBaseUrl();
            //$url = $https ? 'https://' : 'http://';
            $url = $baseUrl . '/' . $path;
            if ($params) {
                $params = http_build_query($params);
                $url .= '?' . $params;
            }
            header('Location:' . $url);
            ob_end_clean();
        }
    }
}