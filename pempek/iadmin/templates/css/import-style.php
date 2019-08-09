<?php
error_reporting(0);
header('Content-type: text/css');
ob_start("compress");
function compress($buffer) {
  /* remove comments */
  $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
  /* remove tabs, spaces, newlines, etc. */
  $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
  return $buffer;
}
/* Site CSS */
function inc($file){
	if(!empty($file) && file_exists($file))
	require_once($file);
}

/* Site CSS */
inc('reset.css');
inc('default.css');
inc('content.css');
inc('table.css');
inc('forms.css');
inc('colors.css');
inc('jquery.uniform.css');
inc('notification.css');
inc('jquery-linedtextarea.css');
inc('css3buttons.css');
inc('ihome.css');

ob_end_flush();