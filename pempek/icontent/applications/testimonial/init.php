<?php
/**
 * @file init.php
 *
 */
//dilarang mengakses
defined('_iEXEC') or die();

if(!function_exists('menu')){
	function menu(){
		$r   = array();
		$r[] = array(
				'title' => 'Home',
				'link'  => '?admin&apps=testimonial'
				);
		$r[] = array(
				'title' => 'Un Aproved',
				'link'  => '?admin&apps=testimonial&go=unaproved'
				);
		return $r;
	}
}


if(!function_exists('update_testimonial')){
	function update_testimonial($data,$id){
		global $db;
		$update = $db->update("testimonial",$data,compact('id'));
		if($update) _e('<div id="success"><strong>SUCCESS</strong>: Testimonial berhasil diperbaharui.</div>');
	}
}

if(!function_exists('del_testimonial')){
	function del_testimonial($id){
		global $db;
		$db->delete("testimonial",compact('id'));
	}
}

if(!function_exists('update_testimonial')){
	function update_testimonial($data,$id){
		global $db;
		$update = $db->update("menu_user",$data,compact('id'));
		if($update) _e('<div id="success"><strong>SUCCESS</strong>: Menu User berhasil diperbaharui.</div>');
	}
}