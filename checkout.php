<?php
include_once 'wp-load.php';
define('PATH_BASE', dirname(__FILE__));
if (!function_exists('add_action')) {
  require_once "wp-config.php";
}
if (!function_exists('wp_handle_upload')) {
  require_once "wp-admin/includes/admin.php";
}
$templatePath = get_template_directory();

include_once $templatePath . '/functions.php';

$requestUri = $_SERVER['REDIRECT_URL'];
$httpRequest = explode('/', $requestUri);

$fileRequest = (isset($httpRequest[2]) && trim($httpRequest[2]) != '') ? $httpRequest[2] . '.php' : '';
$actionRequest = (isset($httpRequest[3]) && trim($httpRequest[3]) != '') ? $httpRequest[3] : 'default';
if ($fileRequest && file_exists($templatePath . '/checkout/' . $fileRequest)) {
    include_once $templatePath . '/checkout/' . $fileRequest;
} else {
    _e('<h3>File request not exists!</h3>');
}