<?php
/**
 * @file function-call.php
 * 
 */
 
//not direct access
defined('_iEXEC') or die();
/**
 * membuat funsi untuk global var $iw
 */	
function config()
{
	global $iw;
	$iw = new config;
	return $iw;
}

function iw( $func ){
	$argvar 	= func_get_args();
   	$funcargs 	= array_slice( $argvar, 1 ); 
	if ( function_exists( $func ) ){
		return call_user_func_array( $func, $funcargs );
	}else{
		if ( function_exists( $func ) ){
		  return call_user_func_array( $func, $funcargs );
	   	}else{
			print_error('Fungsi tidak diketahui!','Maaf Fungsi "'.$func.'" gagal dipanggil kerna fungsi tsb tidak terdapat dlm library kami');		
	   	}
	}
}

function iw_import( $file ){
	$ext = '.php';
	//is array()
	if( is_array( $file ) && !empty( $file ) )
	foreach( $file as $libs ){
	if( file_exists( $libs . $ext ) 
	&& !empty( $libs ) )
	include_once( $libs . $ext );		
	unset( $libs );
	}
}

function call($param){
	if(!empty($_GET[$param]) 
	&& !isset($_GET[$param]) ? null : $_GET[$param] 
	&& !preg_match('/\.\./', $_GET[$param] ))
	return filter( 'text', array( 'string'=>$_GET[$param] ));
}

function call_app( $call ){
	$file_call = App . $call .'/'. $call . '.php';
	if( file_exists( $file_call ) && !empty( $call ) )
	return $file_call;
}

function call_app_function( $call ){
	$file_call = App . $call .'/func'. '.php';
	if( file_exists( $file_call ) && !empty( $call ) )
	return $file_call;
}

function call_app_file( $call, $app ){
	$file_call = App . $app .'/load.'.$call . '.php';
	if( file_exists( $file_call ) && !empty( $app )	&& !empty( $call ) )
	return $file_call;
}

function call_front( $call ){
	$file_call = Front . $call . '.php';
	if( file_exists( $file_call ) && !empty( $call ) )
	return $file_call;
}

function call_tpl( $call ){
	global $tpl;
	$file_call = Thm . get_option('template') .'/'. $call . '.php';
	if( file_exists( $file_call ) && !empty( $call ) )
	return $file_call;
}

function print_error( $error_title, $error_desc ){
	return die( include_once( Front . 'error.php' )	);
}

function print_offline(){
	return die( include_once( Front . 'offline.php' )	);
}