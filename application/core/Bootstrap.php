<?php

include APPLICATION_PATH . 'config.php';
include 'Functions.php';
include 'Router.php';
include 'Application.php';
include 'Ajax.php';

$router = new Router();
$application = new Application();

if( isset( $_GET['lang'] ) )
{
    setcookie('lang', $_GET['lang'], time() + (3600 * 24 * 30), '/');
}

if( $router->fragment(0) === 'ajax' )
{
    $ajax = new Ajax();
    
    $action = $router->fragment(1);
    
    if( $action != false && method_exists( $ajax, $action ) ) echo json_encode( $ajax->{$action}() );
    else json_encode(array('status' => 'error'));
}
elseif( $router->fragment(0) === 'channel' )
{
	$cache_expire = 60*60*24*365;
	header("Pragma: public");
	header("Cache-Control: maxage=".$cache_expire);
	header('Expires: '.gmdate('D, d M Y H:i:s', time()+$cache_expire).' GMT');
	echo '<script src="//connect.facebook.net/en_US/all.js"></script>';	
}
else
{
	include APPLICATION_PATH . 'templates/layout/template.php';
}