<?php
/**
 * @file: seo.php
 * @type: plugin
 */
/*
Plugin Name: Editor
Plugin URI: http://cmsid.org/#
Description: Plugin Text Editor.
Author: Eko Azza
Version: 1.1.0
Author URI: http://cmsid.org/
*/ 
//not direct access
defined('_iEXEC') or die();

if(!function_exists('load_text_editor')){
	function load_text_editor(){
		$name = get_option('text_editor');
		if(file_exists(Plg.'editor/include/'.$name.'/'.$name.'.php'))
		include Plg.'editor/include/'.$name.'/'.$name.'.php';
	}
}

load_text_editor();

