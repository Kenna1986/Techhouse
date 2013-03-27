<?php
if (!class_exists('Request')) {
    class Request
    {
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

        public static function getPost($key, $default = null)
        {
            if (isset($_POST[$key])) {
                return $_POST[$key];
            }
            return $default;
        }

        public static function getPosts()
        {
            if ($_POST) {
                return $_POST;
            }
            return array();
        }
    }
}