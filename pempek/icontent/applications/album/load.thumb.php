<?php
/**
 * @file load.thumb.php
 *
 */
//dilarang mengakses
defined('_iEXEC') or die();

$src 	= filter_txt($_GET['src']);
$x 		= filter_int($_GET['x']);
$y 		= filter_int($_GET['y']);
$c 		= filter_int($_GET['c']);
if(file_exists(Upload.'albums/'.$src) && !empty($src)){
	global $iw;	
	crop_image($iw->base_url."icontent/uploads/albums/".$src,$x,$y,$c);
}
