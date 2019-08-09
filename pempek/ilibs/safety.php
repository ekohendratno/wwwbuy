<?php
/**
 * @file default-constants.php
 *
 */
//dilarang mengakses
defined('_iEXEC') or die();

function register_globals(){
if (ini_get('register_globals') == 1){
	print_error('Register Globals','<i>register_globals</i> is enabled. System requires this configuration directive to be disable. Your site may not secure when <i>register_globals</i> is enabled');
}
}

function unregister_globals(){
	if( !ini_get( 'register_globals' ))
	return;
	
	//kill register_globals
	if (ini_get('register_globals') == 1)
	{
	if (is_array($_REQUEST)) foreach(array_keys($_REQUEST) as $var_to_kill) unset($$var_to_kill);
	if (is_array($_SESSION)) foreach(array_keys($_SESSION) as $var_to_kill) unset($$var_to_kill);
	if (is_array($_SERVER))  foreach(array_keys($_SERVER)  as $var_to_kill) unset($$var_to_kill);
																			unset($var_to_kill);
	}
	
	if( isset( $_REQUEST['GLOBALS'] ) )
	die( 'GLOBALS overwrite attempt detected' );
	
	//variable yang tidak di unset
	$no_unset = array( 'GLOBALS', '_GET', '_POST', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
	
	$input = array_merge( $_GET, $_POST, $_COOKIE, $_SERVER, $_ENV, $_FILES, isset( $_SESSION ) && is_array( $_SESSION ) ? $_SESSION : array() );
	
	foreach ( $input as $k => $v){
		if( !in_array( $k , $no_unset ) && isset( $GLOBALS[$k] ) ){
			$GLOBALS[$k] = null;
			unset( $GLOBALS[$k] );
		}
	}
}

function php_self(){
	global $PHP_SELF;
	
	$default_server_value = array(
		'SERVER_SOFTWARE' 	=> '',
		'REQUEST_URI' 		=> '',
	);
	
	$_SERVER = array_merge( $default_server_value, $_SERVER );
	//fix IIS agar jalan di PHP ISAPI
	if( empty( $_SERVER['REQUEST_URI'] ) || ( php_sapi_name() != 'cgi-fcgi' && preg_match( '/^Microsoft-IIS\//', $_SERVER['SERVER_SOFTWARE'] ) ) ){
		//IIS mode rewrite
		if ( isset( $_SERVER['HTTP_X_ORIGINAL_URL'] ) ) {
			$_SERVER['REQUEST_URI'] = $_SERVER['HTTP_X_ORIGINAL_URL'];
		}
		//IIS isapi rewrite
		else if ( isset( $_SERVER['HTTP_X_REWRITE_URL'] ) ) {
			$_SERVER['REQUEST_URI'] = $_SERVER['HTTP_X_REWRITE_URL'];
		} else {
			//gunakan PATH_INFO jika tidak ditemukan PATH_INFO
			if ( !isset( $_SERVER['PATH_INFO'] ) && isset( $_SERVER['ORIG_PATH_INFO'] ) )
				$_SERVER['PATH_INFO'] = $_SERVER['ORIG_PATH_INFO'];
				
			//IIS + PHP konfigurasi PATH_INFO
			if ( isset( $_SERVER['PATH_INFO'] ) ) {
				if ( $_SERVER['PATH_INFO'] == $_SERVER['SCRIPT_NAME'] )
					$_SERVER['REQUEST_URI'] = $_SERVER['PATH_INFO'];
				else
					$_SERVER['REQUEST_URI'] = $_SERVER['SCRIPT_NAME'] . $_SERVER['PATH_INFO'];
			}
			//query string jika tidak kosong
			if ( ! empty( $_SERVER['QUERY_STRING'] ) ) {
				$_SERVER['REQUEST_URI'] .= '?' . $_SERVER['QUERY_STRING'];
			}
		}
	}
	
	//fix untuk PHP pada CGI
	if ( isset( $_SERVER['SCRIPT_FILENAME'] ) && ( strpos( $_SERVER['SCRIPT_FILENAME'], 'php.cgi' ) == strlen( $_SERVER['SCRIPT_FILENAME'] ) - 7 ) )
		$_SERVER['SCRIPT_FILENAME'] = $_SERVER['PATH_TRANSLATED'];
		
	//fix untuk Dreamhost dan PHP yang lainnya pada CGI host
	if ( strpos( $_SERVER['SCRIPT_NAME'], 'php.cgi' ) !== false )
		unset( $_SERVER['PATH_INFO'] );
		
	//fix jika PHP_SELF kosong
	$PHP_SELF = $_SERVER['PHP_SELF'];
	if ( empty( $PHP_SELF ) )
		$_SERVER['PHP_SELF'] = $PHP_SELF = preg_replace( '/(\?.*)?$/', '', $_SERVER["REQUEST_URI"] );
}

function magic_quotes(){
	// jika tersedia slashes, strip
	if ( get_magic_quotes_gpc() ) {
		$_GET    = stripslashes_deep( $_GET    );
		$_POST   = stripslashes_deep( $_POST   );
		$_COOKIE = stripslashes_deep( $_COOKIE );
	}

	// escape di $db
	$_GET    = add_magic_quotes( $_GET    );
	$_POST   = add_magic_quotes( $_POST   );
	$_COOKIE = add_magic_quotes( $_COOKIE );
	$_SERVER = add_magic_quotes( $_SERVER );

	// memaksa REQUEST pada GET + POST.
	$_REQUEST = array_merge( $_GET, $_POST );
}