<?php
/**
 * @file default-constants.php
 *
 */
//dilarang mengakses
defined('_iEXEC') or die();

function gets_filter($format = null){
$filter = array('apps','sys','go','keys','act','com','view','id','pg');
foreach($filter as $keys){
	$_GET[$keys] 	= !isset($_GET[$keys]) 	? null : $_GET[$keys];
}}

function session(){
	session_start();
	session_name('id|system');
}

function timezone(){
	if(function_exists("date_default_timezone_set") and function_exists("date_default_timezone_get"))
	@date_default_timezone_set('UTC');
	return true;
}

function compression(){
	if ( ini_get( 'zlib.output_compression' ) || 'ob_gzhandler' == ini_get( 'output_handler' ) ) {
		if (function_exists( 'ob_gzhandler' ) )
		{
			ob_start( 'ob_gzhandler' );
		}
	}
}

function handler($errno, $errstr, $errfile, $errline){
    switch ( $errno ) {
    case E_USER_ERROR:
        if ($errstr == "(SQL)"){
			$error_title= "MySQL";
			$error_desc = "";
            $error_desc.= "Kerusakan pada SQL [$errno] " . SQLMESSAGE . "<br />\n";
            $error_desc.= "Query : " . SQLQUERY . "<br />\n";
            $error_desc.= "Pada baris " . SQLERRORLINE . " di file " . SQLERRORFILE . " ";
            $error_desc.= ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
            $error_desc.= "Digagalkan...<br />\n";
        } else {
			$error_title= "PHP";
			$error_desc = "";
            $error_desc.= "Kerusakan pada PHP [$errno] $errstr<br />\n";
            $error_desc.= "  Kerusakan fatal pada baris $errline di file $errfile";
            $error_desc.= ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
            $error_desc.= "Digagalkan...<br />\n";
        }
		print_error($error_title,$error_desc);	
        exit(1);
        break;

    case E_USER_WARNING:
    case E_USER_NOTICE:
    }
    return true;
}

function trigger_sql($ERROR, $QUERY, $PHPFILE, $LINE){
    define("SQLQUERY", $QUERY);
    define("SQLMESSAGE", $ERROR);
    define("SQLERRORLINE", $LINE);
    define("SQLERRORFILE", $PHPFILE);
    trigger_error("(SQL)", E_USER_ERROR);
}

function error_handler(){
	return set_error_handler("handler");
}

function quote(){
	@set_magic_quotes_runtime( 0 );
	@ini_set( 'magic_quotes_sybase', 0 );
	return true;
}

function encoding() {
	global $iw;
	if ( function_exists( 'mb_internal_encoding' ) ) {
		if ( !@mb_internal_encoding( $iw->charset ) )
			mb_internal_encoding( 'UTF-8' );
			//@header("Content-type: text/html; charset=".$iw->charset.";");
	}
}

function php_version(){
	global $iw;
	$php_version = phpversion();
	if ( version_compare( $iw->php_version, $php_version, '>' ) )
	die( sprintf( 'PHP server Anda adalah version %1$s tetapi id %2$s membutuhkan lebih dari %3$s.', $php_version, $iw->iw_version, $iw->php_version ) );
}

function php_version_compare($ver){
	return substr(phpversion(),0,3) >= $ver;
}

function timer_start(){
	global $timestart;
	$mtime = explode( ' ', microtime() );
	$timestart = $mtime[1] + $mtime[0];
	return true;
}

function timer_stop( $precision = 3 ){
	global $timestart, $timeend;
	$mtime = microtime();
	$mtime = explode( ' ', $mtime );
	$timeend = $mtime[1] + $mtime[0];
	$timetotal = $timeend - $timestart;
	$r = number_format( $timetotal, $precision );
	return $r;
}

function debug_mode(){
	global $iw;
	if( $iw->debug['error'] ){
		if ( defined( 'E_DEPRECATED' ) )
			error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT );
		else
			error_reporting( E_ALL );
			
		if ( $iw->debug['display'] )
			ini_set( 'display_errors', 1 );

		if ( $iw->debug['log'] ) {
			ini_set( 'log_errors', 1 );
			ini_set( 'error_log', Front . '/debug.log' );
		}
	} else {
		if ( defined( 'E_RECOVERABLE_ERROR' ) )
			error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING | E_RECOVERABLE_ERROR );
		else
			error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING );
	}
}

