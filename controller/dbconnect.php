<?php 
require_once  $_SERVER['DOCUMENT_ROOT'].'/erp/config/config.php';
require_once( $_SERVER['DOCUMENT_ROOT'].'/erp/adodb5/adodb.inc.php'); 

global $db;
$databasetype='mysql';
$server = 'localhost';
$user   = 'root';
$password = '';
$database = 'erp';
//echo $database;
$db = ADONewConnection($databasetype); 

$db->debug = false;

$db->Connect($server, $user, $password, $database);
		
?>