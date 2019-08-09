<?php
/**
 * @file default-constants.php
 *
 */
//dilarang mengakses
defined('_iEXEC') or die();

function active_plugins($ext='.php'){
	$plugin = array();
	$active_plugins = list_active_plugins();
	if(is_array($active_plugins))
	foreach ( $active_plugins as $plugin ) {
		if ( !validate_file( $plugin )	){
		if ( file_exists( Plg . $plugin .'/'. $plugin . $ext ) ){
			$plugins[]  = Plg . $plugin .'/'. $plugin . $ext;
		}else{ 		
		if ( file_exists( Plg . $plugin . $ext ) )
			$plugins[]  = Plg . $plugin . $ext;
		}}
	}
	return $plugins;
}

function plugins(){
	if(is_array(iw('active_plugins')))
	foreach ( iw('active_plugins') as $plugin )
		include_once( $plugin );		
	unset( $plugin );
	return true;
}

function cleanup_header($str) {
	return trim(preg_replace("/\s*(?:\*\/|\?>).*/", '', $str));
}

function get_file_data( $file, $default_headers, $context = '' ) {
	$fp 		= fopen( $file, 'r' );
	$file_data 	= fread( $fp, 8192  ); //8kiB
	fclose( $fp );
	
	foreach ( $default_headers as $field => $regex ) {
		preg_match( '/' . preg_quote( $regex, '/' ) . ':(.*)$/mi', $file_data, ${$field});
		if ( !empty( ${$field} ) )
			${$field} = cleanup_header(${$field}[1]);
		else
			${$field} = '';
	}

	$data = compact( array_keys( $default_headers ) );

	return $data;
}

function get_plugin_data( $plugin_file, $markup = true, $translate = true ) {

	$default_headers 	=  array(
		'Name' 			=> 'Plugin Name',
		'PluginURI' 	=> 'Plugin URI',
		'Version' 		=> 'Version',
		'Description' 	=> 'Description',
		'Author' 		=> 'Author',
		'AuthorURI' 	=> 'Author URI',
	);

	$plugin_data = get_file_data( $plugin_file, $default_headers, 'plugin' );
	return $plugin_data;
}

function get_dir_plugins($plugin_folder = '') {

	$plugins 		= array();
	$plugin_root 	= Plg;
	if ( !empty($plugin_folder) )
		$plugin_root .= $plugin_folder;

	// Files in icontent/plugins directory
	$plugins_dir = @ opendir( $plugin_root);
	$plugin_files = array();
	if ( $plugins_dir ) {
		while (($file = readdir( $plugins_dir ) ) !== false ) {
			if ( substr($file, 0, 1) == '.' )
				continue;
			if ( is_dir( $plugin_root.$file ) ) {
				/*
				$plugins_subdir = @ opendir( $plugin_root.$file );
				if ( $plugins_subdir ) {
					while (($subfile = readdir( $plugins_subdir ) ) !== false ) {
						if ( substr($subfile, 0, 1) == '.' )
							continue;
						if ( substr($subfile, -4) == '.php' )
							$plugin_files[] = "$file/$subfile";
					}
				}
				*/
					$plugin_files[] = $file.'/'.$file.'.php';
			} else {
				if ( substr($file, -4) == '.php' )
					$plugin_files[] = $file;
			}
		}
	} else {
		return $plugins;
	}

	@closedir( $plugins_dir );
	@closedir( $plugins_subdir );

	if ( empty($plugin_files) )
		return $plugins;

	foreach ( $plugin_files as $plugin_file ) {
		if ( !is_readable( "$plugin_root/$plugin_file" ) )
			continue;
		
		$plugin_data = get_plugin_data( "$plugin_root/$plugin_file", false, false ); 
		if ( empty ( $plugin_data['Name'] ) )
			continue;

		$plugins[plugin_basename( $plugin_file )] = $plugin_data;
		//echo "$plugin_root/$plugin_file<br>";
		//echo  $plugin_data['Name'];
	}
	uasort( $plugins, create_function( '$a, $b', 'return strnatcasecmp( $a["Name"], $b["Name"] );' ));
	
	return $plugins;

}

function plugin_name($string){
	if( empty($string) )
		return false;
	
	if(	explode('/',$string) || explode('.php',$string)):
		$string = explode('.php',$string);
		$string = explode('/',$string[0]);
		return $string[0];
	endif;
}

/*
$plugins = get_dir_plugins();
foreach($plugins as $key => $val){
	echo 'Name 			:'.$val['Name'].'<br>';
	echo 'PluginURI 	:'.$val['PluginURI'].'<br>';
	echo 'Version 		:'.$val['Version'].'<br>';
	echo 'Description 	:'.$val['Description'].'<br>';
	echo 'Author 		:'.$val['Author'].'<br>';
	echo 'AuthorURI 	:'.$val['AuthorURI'].'<br>';
	echo 'File 			:'.$key.'<br><br>';
}
/*
if ( !empty($plugins) ) {
$keys = array_keys($plugins);
$plugin_file = $plugin_slug . '/' . $keys[0];
$action = '<a href="plugins.php?action=activate&plugin=' . $plugin_file . '&from=import" "title="">' . $data[0] . '</a>';
}
*/
