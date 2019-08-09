<?php
/**
 * @file: phpids.php
 * @type: plugin
 */
 /*
Plugin Name: PHP IDS
Plugin URI: http://cmsid.org/#
Description: Plugin keamanan dari phpids.org.
Author: Eko Azza
Version: 1.1.0
Author URI: http://cmsid.org/
*/
//not direct access
defined('_iEXEC') or die();

function run_phpids(){
	global $iw,$db;
	
	
	if(php_version_compare(5.1)){
	set_include_path(dirname(__FILE__));
	$request	= array(
	//yang difilter oleh php ids
			
	'GET' 			=> $_GET
	/*
	'REQUEST' 		=> $_REQUEST,
	'COOKIE' 		=> $_COOKIE,
	'POST' 			=> $_POST 
	*/
	);
	require_once 'IDS/Init.php';
	try{
	$init 									= IDS_Init::init(dirname(__FILE__) . '/IDS/Config/Config.ini');		
	$init->config['General']['tmp_path'] 	= dirname(__FILE__) . '/IDS/tmp';
	$init->config['General']['filter_path'] = dirname(__FILE__) . '/IDS/default_filter.xml';
	$init->config['Caching']['caching'] 	= 'none';
	$ids 	= new IDS_Monitor($request, $init);
	$result = $ids->run();
	if (!$result->isEmpty()) {
		require_once 'IDS/Log/Composite.php';
		require_once 'IDS/Log/Database.php'; 
		$compositeLog = new IDS_Log_Composite();    	
		$compositeLog->addLogger(IDS_Log_Database::getInstance($init));
		$compositeLog->execute($result);
		global $Output;
		if (is_array($Output)) {
			$Output 	= array_map('mysql_escape_string',$Output);
			
			$name 		= esc_sql($Output['name']);
			$value 		= esc_sql($Output['value']);
			$page 		= esc_sql($Output['page']);
			$ip 		= esc_sql($Output['ip']);
			$impact 	= esc_sql($Output['impact']);
			$created 	= date('Y-m-d H:i:s');
			
			$data = compact('name','value','page','ip','impact','created');
			$db->insert('phpids',$data);
		}
		//die(
			//print_error('403 Request Not Found','Apologies, but the Request you requested could not be found')
		//);
		else
		{
			redirect();
		}
	}}catch ( Exception $e ){		
			redirect();
		//die ('<center>'.$e->getMessage().'</center>');
	}}
}

//menjalankan fungsi php ids 
if(!function_exists('isecurity')){
	global $access;
	if($access->cek_login()  == false 	&& $access->login_level('admin') == false)
	if(isset($_GET['admin']) == false 	&& empty($_GET['admin'])  == false)	run_phpids();
}