<?php
/**
 * @file: wkrte.php
 * @type: plugin-wkrte
 */ 
//not direct access
defined('_iEXEC') or die();

global $include_rel_script,$fscript;

$include_rel_script[] = '<script type="text/javascript" src="'.plugin_url('editor/include/wkrte/js/wkrte.js').'"></script>';
$include_rel_script[] = '<link type="text/css" href="'.plugin_url('editor/include/wkrte/css/wkrte.css').'" rel="stylesheet" media="screen"/>';
$fscript[] = '
$("#editor").rte({controls_rte:rte_toolbar,controls_html:html_toolbar})
';
