<?php
/**
 * @file: tiny_mce.php
 * @type: plugin-tiny_mce
 */ 
//not direct access
defined('_iEXEC') or die();

global $include_rel_script,$qscript;

$include_rel_script[] = '<script type="text/javascript" src="'.plugin_url('editor/include/tiny_mce/tiny_mce.js').'"></script>';
$qscript[] = '
	tinyMCE.init({
		// General options
		mode : "exact", 
		elements : "editor",
		theme : "advanced",
		skin : "o2k7",
		skin_variant : "silver",
		plugins : "autosave,pagebreak,emotions,preview,media,contextmenu,paste,fullscreen,searchreplace",//style = inlinepopups
		// Theme options
		theme_advanced_buttons1 : "bold,|,italic,|,strikethrough,|,bullist,|,numlist,|,blockquote,|,justifyleft,|,justifycenter,|,justifyright,|,link,|,unlink,|,pagebreak,|,emotions,|,preview,|,image,|,code,|,fullscreen",
		theme_advanced_buttons2 : "formatselect,|,underline,|,justifyfull,|,pastetext,|,pasteword,|,forecolor,|,removeformat,|,media,|,charmap,|,outdent,|,indent,|,undo,|,redo,|,help",
		theme_advanced_buttons3 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : false

	});	
';

?>