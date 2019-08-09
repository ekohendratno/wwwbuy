<?php
/*
 * @copyright	Copyright (C) 2010 Open Source, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
 
/**
 * mulai exekusi id untuk memulai menampilkan output
 *
 * @ content & libs
 */
if (!defined("_iEXEC")):
define('_iEXEC', true);

//error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING); 

/** Loads the id Environment and Template */
//no access if $iwLoad not isset
if( !isset( $iLoad ) ){
	$iLoad = true;

/*
 * start compressing 
 */
if ( ini_get( 'zlib.output_compression' ) || 'ob_gzhandler' == ini_get( 'output_handler' ) ) {
	if (function_exists( 'ob_gzhandler' ) )
	{
		ob_start( 'ob_gzhandler' );
	}
	else ob_start();
}
	
	//load configuration
	require_once( dirname(__FILE__) . '/iconfig.php' ); 

	//load global var $iw
	iw('config');
	
	//impot file system
	require_once( Inc . 'import.php' );		
	iw( 'plugins' );
	
	if(isset($_GET['login']) || isset($_GET['admin']))
	{
		include_once( Back . 'int.php' );
	}
	else
	{
		if(!get_option('web_status') || get_option('web_status') < 1) print_offline();
		else
		{
			iw( 'template' );	
			include_once( Inc . 'framework.php' );
		}
	}	
	
ob_end_flush();
}


endif;
