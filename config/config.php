<?php
	
    $SERVER_ID      =   1;
	$BASE_PATH		=	realpath(__FILE__);
	$THIS_FILE		=	basename($BASE_PATH);
	$SITE_DIR		=	str_replace(array($THIS_FILE,'\\'),array('','/'),$BASE_PATH);
	
	error_reporting(E_ALL & ~E_NOTICE);
	define('WEB_ROOT',$SITE_DIR);
	
	define("HTTP_PATH", "http://" . $_SERVER["HTTP_HOST"] . "/erp/");
	define('CSS_PATH', HTTP_PATH.'/styles/');
	define('JS_PATH', HTTP_PATH.'scripts');
	define('IMAGE_PATH', HTTP_PATH.'/images/');
	
	
	//DATAT BASE CONFIGRATION 

	
	
	
	
	
?>