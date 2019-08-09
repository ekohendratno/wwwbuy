<?php
/**
 * @file: uploader.php
 * @type: plugin
 */
/*
Plugin Name: Uploader
Plugin URI: http://cmsid.org/#
Description: Plugin Files Uploader.
Author: Eko Azza
Version: 1.1.0
Author URI: http://cmsid.org/
*/ 
//not direct access
defined('_iEXEC') or die();

if(!function_exists('resize_image')){
	function resize_image($data){
		
		$path   = filter_txt( $data['path'] );
		$type   = filter_txt( $data['type'] );
		$resize = filter_int( $data['resize'] );
		
		if(!file_exists($path) && !empty($path))
		{
			return false;
		}
		else
		{
			if($type=='.jpg' || $type=='.jpeg') $im_src = imagecreatefromjpeg($path);
			elseif($type=='.gif') $im_src = imagecreatefromgif($path);
			elseif($type=='.png') $im_src = imagecreatefrompng($path);
			else return false;
				
			$src_width 	= imageSX($im_src);
			$src_height = imageSY($im_src);
			$dst_height = ($resize/$src_width)*$src_height;
			
			$im = imagecreatetruecolor($resize,$dst_height);
			imagecopyresampled($im, $im_src, 0, 0, 0, 0, $resize, $dst_height, $src_width, $src_height);
			
			if($type=='.jpg' || $type=='.jpeg') imagejpeg($im,$path);
			elseif($type=='.gif') imagegif($im,$path);
			elseif($type=='.png') imagepng($im,$path);
			else return false;
			  
			imagedestroy($im_src);
			imagedestroy($im);
		}
	}
}

if(!function_exists('uploader')){
	function uploader($data){
		extract($data, EXTR_SKIP);
		
		$uploadFile = $uploadDir . basename($myfile['name']);
		
        if (move_uploaded_file($myfile['tmp_name'], $uploadFile)) {
            _e('<div id="success">File successfully uploaded!</div>');
			return true;
        } else {
			$msg = array();
            switch ($myfile['error']) {
                case 1:
                    $msg[]= 'The file is bigger than this PHP installation allows';
                    break;
                case 2:
                    $msg[]= 'The file is bigger than this form allows';
                    break;
                case 3:
                    $msg[]= 'Only part of the file was uploaded';
                    break;
                case 4:
                    $msg[]= 'No file was uploaded';
                    break;
                default:
                    $msg[]= 'unknown error';
            }
			if( is_array($msg))	{
			foreach($msg as $val){
				_e('<div id="error">'.$val.' </div>');
			}
		}}
	}
}