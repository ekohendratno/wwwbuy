<?php
/**
 * @file default-filter.php
 *
 */
//dilarang mengakses
defined('_iEXEC') or die();

function plugin_basename($file){
	$file = str_replace('\\','/', $file);
	$file = preg_replace('|/+|','/', $file);
	$plugin_dir = str_replace('\\','/', Plg);
	$plugin_dir = preg_replace('|/+|','/', $plugin_dir);
	$file = preg_replace('#^' . preg_quote($plugin_dir, '#') . '/#','', $file);
	$file = trim($file, '/');
	return $file;
}

function validate_file( $file, $allowed_files = '' ) {
	if ( false !== strpos( $file, '..' ))
		return 1;

	if ( false !== strpos( $file, './' ))
		return 1;

	if (!empty ( $allowed_files ) && (!in_array( $file, $allowed_files ) ) )
		return 3;

	if (':' == substr( $file, 1, 1 ))
		return 2;

	return 0;
}

function esc_sql( $data ){
	global $db;
	return $db->escape( $data );
}

function addslashes_gpc($gpc) {
	if ( get_magic_quotes_gpc() )
		$gpc = stripslashes($gpc);

	return esc_sql($gpc);
}

function stripslashes_deep($value){
	if ( is_array($value) ) {
		$value = array_map('stripslashes_deep', $value);
	} elseif ( is_object($value) ) {
		$vars = get_object_vars( $value );
		foreach ($vars as $key=>$data) {
			$value->{$key} = stripslashes_deep( $data );
		}
	} else {
		$value = stripslashes($value);
	}

	return $value;
}

function add_magic_quotes( $array ){
	foreach ( (array) $array as $k => $v ) {
		if ( is_array( $v ) ) {
			$array[$k] = add_magic_quotes( $v );
		} else {
			$array[$k] = addslashes( $v );
		}
	}
	return $array;
}

function filter( $tag, $value, $html=true ){
	switch( $tag ){
	case'int':
		if (is_numeric ( $value )){
		$r = (int)preg_replace ( '/\D/i', '', $value);
		}
		else {
			$value = ltrim( $value, ';' );
			$value = explode ( ';', $value );
			$r = (int)preg_replace ( '/\D/i', '', $value[0] );
		}
		return $r;
	break;
	case'text':
	/*
	* array(
	* 'string'	=>'1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ~`!@#$%^&*()_+,>< .?/:;"\'{[}]|\_-+=',
	* 'type'	=>''
	* );
	*/
	if( !empty( $value['string'] ) ){
		if(!empty($value['type']) && intval( $value['type'] ) == 2){
        	$r = htmlspecialchars( trim( $value['string'] ), ENT_QUOTES );
		} else {
			$r = strip_tags( urldecode( $value['string'] ) );
			$r = htmlspecialchars( trim( $r ), ENT_QUOTES );
		}
		return $r;
	}
	break;
	case'editor':
	if( !empty( $value ) ){
		$value = preg_replace( '[\']', '\'\'', $value );
		$value = preg_replace( '[\'\'/]', '\'\'', $value );
		return $value;
	}
	break;
	case'post':
	if( !empty( $value ) ){
		return htmlspecialchars(get_magic_quotes_gpc() ? $_POST[$value] : addslashes($_POST[$value]));
	}
	break;
	/*
	* array(
	* 'string'	=>'1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ~!@#$%^&*()_+,>< .?/:;"\'{[}]|\_-+=',
	* 'type'	=>'htmlentities'
	* );
	*/
	case'request':
	if( !empty( $value['string'] ) ){
		$type = array('urlencode','strip_tags','htmlentities');
		foreach( $type as $k )
		if( $value['type'] == $k)
		return is_array($value['string']) ? array_map('filter', $value['string']) : $k($value['string']);
	}	
	break;
	case'persistency':
	if( !empty( $value ) ){
		if( !array( $value ) ){
		return (!isset($value) ? null : $value);	
		}else{
		/*
		* array(0,1,2);
		*/
		return (!isset($value[0]) ? $value[1] : $value[2]);
		}
	}	
	break;
	case'clear':
	if( !empty( $value ) ){
		return preg_replace( '/[!"\#\$%\'\(\)\?@\[\]\^`\{\}~\*\/]/', '', $value );
	}
	break;
	case'clean':
	if( !empty( $value ) ){
		$value = preg_replace( "'<script[^>]*>.*?</script>'si", '', $value );
        $value = preg_replace( '/<a\s+.*?href="([^"]+)"[^>]*>([^<]+)<\/a>/is', '\2 (\1)', $value );
        $value = preg_replace( '/<!--.+?-->/', '', $value );
        $value = preg_replace( '/{.+?}/', '', $value );
        $value = preg_replace( '/&nbsp;/', ' ', $value );
        $value = preg_replace( '/&amp;/', ' ', $value );
        $value = preg_replace( '/&quot;/', ' ', $value );		
		$value = preg_replace( '[\']', '&#039;', $value );
		$value = preg_replace( '/&#039;/', '\'\'', $value );
        $value = strip_tags( $value );
        $value = preg_replace("/\r\n\r\n\r\n+/", " ", $value);
        $value = $html ? htmlspecialchars( $value ) : $value;
        return $value;
	}
	break;
	case'file':
	/*
	array(
	string  => 'file.jpg'
	type	=> array('jpg,gif,png')
	)
	*/
	if(!empty($value['string']))
		foreach(is_array($value['type']) as $type)
			if('.'.$type == substr( $value['string'], -4 ))
			return $value['string'];
	break;
	}
}

function filter_vars( $call, $str ){
	/*
	* example
	*
	* $str='someone@exassmple.com';
	* if( !filter_vars( 'val_email', $str ) ){
	*	echo 'salah';
	* }else{
	*	echo 'benar';
	* }
	*/
	$call = filter( 'text', array( 'string'=>$call ) ); 
	// list php filter for filter_var();
	$list = array(
	
		//Call a user-defined function to filter data
		'call_back'		=> FILTER_CALLBACK,
		
		//Strip tags, optionally strip or encode special characters
		'clear_string'	=> FILTER_SANITIZE_STRING,
		
		//Alias of "string" filter
		'clear_strip'	=> FILTER_SANITIZE_STRIPPED,
		
		//URL-encode string, optionally strip or encode special characters
		'clear_encode'	=> FILTER_SANITIZE_ENCODED,
		
		//HTML-escape '"<>& and characters with ASCII value less than 32
		'clear_chars'	=> FILTER_SANITIZE_SPECIAL_CHARS,
		
		//Remove all characters, except letters, digits and !#$%&'*+-/=?^_`{|}~@.[]
		'clear_email'	=> FILTER_SANITIZE_EMAIL,
		
		//Remove all characters, except letters, digits and $-_.+!*'(),{}|\\^~[]`<>#%";/?:@&=
		'clear_url'		=> FILTER_SANITIZE_URL,
		
		//Remove all characters, except digits and +-
		'clear_int'		=> FILTER_SANITIZE_NUMBER_INT,
		
		//Remove all characters, except digits, +- and optionally .,eE
		'clear_float'	=> FILTER_SANITIZE_NUMBER_FLOAT,
		
		//Apply addslashes()
		'clear_quotes'	=> FILTER_SANITIZE_MAGIC_QUOTES,
		
		//Do nothing, optionally strip or encode special characters
		'unsafe_raw'	=> FILTER_UNSAFE_RAW,
		
		//Validate value as integer, optionally from the specified range
		'val_int'		=> FILTER_VALIDATE_INT,
		
		//Return TRUE for "1", "true", "on" and "yes", FALSE for "0", "false", "off", "no", and "", NULL otherwise
		'val_boolean'	=> FILTER_VALIDATE_BOOLEAN,
		
		//Validate value as float
		'val_float'		=> FILTER_VALIDATE_FLOAT,
		
		//Validate value against regexp, a Perl-compatible regular expression
		'val_regexp'	=> FILTER_VALIDATE_REGEXP,
		
		//Validate value as URL, optionally with required components
		'val_url'		=> FILTER_VALIDATE_URL,FILTER_FLAG_QUERY_REQUIRED,
		
		//Validate value as e-mail
		'val_email'		=> FILTER_VALIDATE_EMAIL,
		
		//Validate value as IP address, optionally only IPv4 or IPv6 or not from private or reserved ranges
		'val_ip'		=> FILTER_VALIDATE_IP
	);
	foreach( $list as $val => $key){
		if( $call !== $val ){
			return false;
		}else{
			if( !function_exists( 'filter_var' ) ){
			}else{
				if( !filter_var( $str, $key) ){
					return false;
				}else{
					return true;
				}
			}
		}
	}
}


