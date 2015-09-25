<?php
// Enable all the errors, to se what's wrong!
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);

/********** General Definitions **********/
define('DS', DIRECTORY_SEPARATOR);
define('HTTP_PROTOCOL', isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http');
define('IS_AJAX_REQUEST', (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'));
// Application Paths
define('BASE_PATH', rtrim(dirname(__FILE__)) . DS);
    define('APPLICATION_PATH', BASE_PATH . 'application' . DS);
// Application URLs
define('BASE_URL', rtrim(HTTP_PROTOCOL . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']), '/') . '/');
define('ASSETS_URL', BASE_URL . 'assets/');
define('AJAX_URL', BASE_URL . 'ajax/');
// Other URLs
define('FACEBOOK_URL', HTTP_PROTOCOL . '://www.facebook.com');

/********** Routing stuff **********/
define('CURRENT_URL', HTTP_PROTOCOL . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
define('CURRENT_URI', str_replace('index.php', '', str_replace(BASE_URL, '', CURRENT_URL))); // whats the current uri?
define('CURRENT_URI_WITHOUT_QUERY_STRING', str_replace('?' . $_SERVER['QUERY_STRING'], '', CURRENT_URI)); // whats the current uri w/o query string?

// Load the bootstrap file
include APPLICATION_PATH . 'core/Bootstrap.php';