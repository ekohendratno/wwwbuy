<?php
/**
 * @file framework.php
 * 
 */
 
//not direct access
defined('_iEXEC') or die();

$app 	= call('app');
$load 	= call('load');
if( isset($app) && !empty($app) && !isset($app) ? null : $app && !preg_match('/\.\./', $app)){	
if( isset($load) && !empty($load) && !isset($load) ? null : $load && !preg_match('/\.\./', $load)){
if(!call_app_file($load, $app)){
	print_error('File tidak ada!','Maaf file yang anda panggil tidak ada');
}else{
	include_once(call_app_file( $load, $app ));
}}}




