<?php
/**
 * @file import.php
 * 
 */
 
//not direct access
defined('_iEXEC') or die();
/*
 * Load the loader class.
 */
$libs = array(
	'encryption',
	'session',	
	'html',
	'safety',
	'json',
	'default-constants',
	'filters',
	'settings',
	'mysql',
	'function',
	'update-core',
	'access',
	'forms_generator',
	'plugin',
	'paging',
	'permalinks',
	'sidebar',
	'template-general'
);

foreach( $libs as $llibs)
$libs[] = Inc . $llibs;
iw_import( $libs );





