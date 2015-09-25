<?php

function __( $str = '' )
{
	$lang = getLanguage();
    
    if( file_exists( APPLICATION_PATH . 'languages/' . $lang . '.php' ) )
    {
        $translations = include APPLICATION_PATH . 'languages/' . $lang . '.php';
        
        if( isset( $translations ) && isset( $translations[$str] ) ) $str = $translations[$str];
    }
    
    return $str;
}

function getLanguage()
{
    $lang = 'en';
    
    if( isset( $_COOKIE['lang'] ) ) $lang = $_COOKIE['lang'];
    if( isset( $_GET['lang'] ) ) $lang = $_GET['lang'];	
    
    if( ! file_exists( APPLICATION_PATH . 'languages/' . $lang . '.php' ) ) $lang = 'en';
    
    return $lang;
}

function getTypeForPdo( $input = null )
{
	$type = gettype( $input );
	
	if( $type == 'boolean' || $type == 'integer' || $type == 'double' ) $type = PDO::PARAM_INT;
	elseif( $type == 'string' ) $type = PDO::PARAM_STR;
	else $type = PDO::PARAM_STR;
	
	return $type;
}