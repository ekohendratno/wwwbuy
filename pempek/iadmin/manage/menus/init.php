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
				'link'  => '?admin&amp;sys=menus'
				);
		$r[] = array(
				'title' => 'User Panel',
				'link'  => '?admin&amp;sys=menus&go=userpanel'
				);
		return $r;
	}
}

if(!function_exists('update_menu')){
	function update_menu($data,$id){
		global $db;
		$update = $db->update("menu",$data,compact('id'));
		if($update) _e('<div id="success"><strong>SUCCESS</strong>: Box Menu berhasil diperbaharui.</div>');
	}
}

if(!function_exists('update_sub_menu')){
	function update_sub_menu($data,$id){
		global $db;
		$update = $db->update("menu_sub",$data,compact('id'));
		if($update) _e('<div id="success"><strong>SUCCESS</strong>: Menu berhasil diperbaharui.</div>');
	}
}

if(!function_exists('update_menu_user')){
	function update_menu_user($data,$id){
		global $db;
		$update = $db->update("menu_user",$data,compact('id'));
		if($update) _e('<div id="success"><strong>SUCCESS</strong>: Menu User berhasil diperbaharui.</div>');
	}
}

if(!function_exists('add_menu')){
	function add_menu($data){
		global $iw,$db;
		$cekmax 	= $db->query("SELECT (MAX(`ordering`)+1) FROM ".$iw->pre."menu");
		$getcekmax 	= $db->fetch_row($cekmax);
		
		$ordering 	= filter_int( $getcekmax[0] );
		
		$run = $db->insert("menu",$data + compact('ordering'));
		if($run) _e('<div id="success"><strong>SUCCESS</strong>: Box Menu berhasil ditambahkan.</div>');
	}
}

if(!function_exists('add_sub_menu')){
	function add_sub_menu($data){
		global $iw,$db;
		$cekmax 	= $db->query("SELECT (MAX(`ordering`)+1) FROM ".$iw->pre."menu_sub");
		$getcekmax 	= $db->fetch_row($cekmax);
		
		$ordering 	= filter_int( $getcekmax[0] );
		$run = $db->insert("menu_sub",$data + compact('ordering'));
		if($run) _e('<div id="success"><strong>SUCCESS</strong>: Menu berhasil ditambhakan.</div>');
	}
}

if(!function_exists('add_menu_user')){
	function add_menu_user($data){
		global $iw,$db;
		$cekmax 	= $db->query("SELECT (MAX(`ordering`)+1) FROM ".$iw->pre."menu_user");
		$getcekmax 	= $db->fetch_row($cekmax);
		
		$ordering 	= filter_int( $getcekmax[0] );
		$run = $db->insert("menu_user",$data + compact('ordering'));
		if($run) _e('<div id="success"><strong>SUCCESS</strong>: Menu User berhasil ditambahkan.</div>');
	}
}

if(!function_exists('update_action_menus')){
	function update_action_menus($data){
	global $db;		
	if (is_array($data)) {
		foreach($data['ida'] as $key=>$val) {
			$id      = (int)esc_sql( $data['ida'][$key] );
			$ordering= (int)esc_sql( $data['ordera'][$key] );
			$run[]   = $db->update("menu", compact('ordering'), compact('id'));
		}
		foreach($data['idb'] as $key=>$val) {
			$id      = (int)esc_sql( $data['idb'][$key] );
			$ordering= (int)esc_sql( $data['orderb'][$key] );
			$orderby = (int)esc_sql( $data['orderby'][$key] );
			$run[]   = $db->update("menu_sub", compact('ordering','orderby'), compact('id'));
		}
		if($run) _e('<div id="success"><strong>SUCCESS</strong>: Ordering berhasil diperbaharui.</div>');
	}}
}

if(!function_exists('update_order_menu_user')){
	function update_order_menu_user($data){
	global $db;		
	if (is_array($data)) {
		foreach($data['id'] as $key=>$val) {
			$id      = (int)esc_sql( $data['id'][$key] );
			$ordering= (int)esc_sql( $data['order'][$key] );
			$run[]   = $db->update("menu_user", compact('ordering'), compact('id'));
		}
		if($run) _e('<div id="success"><strong>SUCCESS</strong>: Ordering berhasil diperbaharui.</div>');
	}}
}

if(!function_exists('del_menu')){
	function del_menu($id){
		global $db;
		$db->delete("menu",compact('id'));
		$db->delete("menu_sub",array('orderby'=>$id)); 
	}
}

if(!function_exists('del_sub_menu')){
	function del_sub_menu($id){
		global $db;
		$db->delete("menu_sub",compact('id'));
	}
}

if(!function_exists('del_menu_user')){
	function del_menu_user($id){
		global $db;
		$db->delete("menu_user",compact('id')); 
	}
}
?>