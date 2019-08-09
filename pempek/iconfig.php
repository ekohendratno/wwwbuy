<?php
/**
 * @setting ketentuan website
 * 
 * isi sesuai dengan hak akses ke mysql server anda
 */
 
//not direct access
defined('_iEXEC') or die();

class config
{
	/*
	 *************** Basic Setting *************
	 */

	//nama host mysql db
	var $db_host 		= 'localhost';
	//nama pengguna mysql db
	var $db_user 		= 'root';
	//kata sandi mysql db	
	var $db_password 	= '';
	//nama database mysql	
	var $db_name 		= 'cmsid_order_pempek_cikning';
	//nama awal table
	var $pre 			= 'iw_';
	//web url base
	var $base_url 		= 'http://localhost/cmsid/order/pempek/'; 
	
	
	/*
	 *************** Advanve Setting *************
	 */
 
	//charset database
	var $charset 		= 'utf-8';
	//language
	var $language 		= ''; //en-US
	//debug mode error
	var $debug 			= array(
	'error'				=>false,
	'log'				=>false,
	'display'			=>true
	);
	//id versi
	var $iw_version		= '2.1.0.3';
	//id code
	var $iw_code		= 'butterfly';
	//php versi
	var $php_version	= '4.3';
	//mysql version
	var $mysql_version	= '4.1.2';
	//rss version
	var $rss			= array(
	'version'			=>'2.0',
	'type'				=>'application/rss+xml'
	);
	var $image_allaw	= array(
    'image/png' 		=> '.png',
    'image/x-png' 		=> '.png',
    'image/gif' 		=> '.gif',
    'image/jpeg' 		=> '.jpg',
    'image/pjpeg' 		=> '.jpg');
}

/** Absolute path to the directory. */
if (DIRECTORY_SEPARATOR=='/') 
  $absolute_path = dirname(__FILE__).'/'; 
else 
  $absolute_path = str_replace('\\', '/', dirname(__FILE__)).'/'; 
  
if ( !defined( 'abs_path' ) ) define( 'abs_path',  $absolute_path );
		
	//path id
	define( 'Inc', 			abs_path . '/ilibs/' 	);
	define( 'Back',			abs_path . '/iadmin/' 	);
	define( 'Front',		abs_path . '/icontent/' );
	define( 'Tmp',			abs_path . '/tmp/' 		);	
	 
	define( 'Tpl',			Back  . 'templates/' 	);
	define( 'Mng',			Back  . 'manage/' 		);
	
	define( 'Thm',			Front . 'themes/' 		);
	define( 'Plg',			Front . 'plugins/' 		);
	define( 'App',			Front . 'applications/' );
	define( 'Stylesheet',	Front . 'stylesheet/' 	);
	define( 'Javascripts',	Front . 'javascripts/' 	);
	define( 'Upload',		Front . 'uploads/' 		);
	
//load call function
require_once( Inc . 'function-call.php' );