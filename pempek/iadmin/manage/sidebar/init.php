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
				'link'  => '?admin&amp;sys=sidebar'
				);
		$r[] = array(
				'title' => 'Actions',
				'link'  => '?admin&amp;sys=sidebar&go=actions'
				);
		return $r;
	}
}

if(!function_exists('update_order_sidebar')){
	function update_order_sidebar($data){
		global $db;
		extract($data, EXTR_SKIP);
		for($i=0; $i<=count($id_sidebar)-1; $i++){
			$id 	  = esc_sql( (int)$id_sidebar[$i] 	);
			$ordering = esc_sql( (int)$order_sidebar[$i]);
			if(empty($ordering)) $order = false;
			$update[] = $db->update("sidebar",compact('ordering'),compact('id'));
		}
		if($update) _e('<div id="success"><strong>SUCCESS</strong>: Posisi Sidebar berhasil di perbaharui</div>');
	}
}

if(!function_exists('update_sidebar')){
	function update_sidebar($data,$id){
		global $db;
		$update = $db->update("sidebar",$data,compact('id'));
		if($update) _e('<div id="success"><strong>SUCCESS</strong>: Sidebar berhasil diperbaharui.</div>');
	}
}

if(!function_exists('update_action_sidebar')){
	function update_action_sidebar($posisix,$order){
	global $db;	
	
	if (is_array($order)) {
		foreach($order as $key=>$val) {
			$posisi = filter_int( $posisix[$key]	);
			$order 	= filter_int( $val			  	);
			$id		= filter_int( $key				);
			
			$posisi = esc_sql( $posisi	);
			$order 	= esc_sql( $order	);
			$id		= esc_sql( $id		);
			$where  = compact('posisi','order');
			//echo 'posisi:'.$posisi.'->order:'.$order.'->id:'.$id.'<br>';
			$run[]  = $db->update("sidebar_act", $where, compact('id'));
		}
		if($run) _e('<div id="success"><strong>SUCCESS</strong>: Actions berhasil diperbaharui.</div>');
	}}
}

if(!function_exists('insert_sidebar')){
	function insert_sidebar($data){
		global $iw,$db;
		
		$cekmax 	= $db->query("SELECT (MAX(`ordering`)+1) FROM ".$iw->pre."sidebar");
		$getcekmax 	= $db->fetch_row($cekmax);
		
		$ordering 	= filter_int( $getcekmax[0] );
		
		$insert 	= $db->insert("sidebar",$data + compact('ordering'));
		
		if($insert) _e('<div id="success"><strong>SUCCESS</strong>: Sidebar berhasil ditambahkan.</div>');
	}
}

if(!function_exists('insert_action_sidebar')){
	function insert_action_sidebar($data){
		global $iw,$db;
		extract($data, EXTR_SKIP);
		
		$cekmax 	= $db->query("
		SELECT (MAX(`order`)+1) 
		FROM `".$iw->pre."sidebar_act` 
		WHERE `posisi` = '".$posisi."' AND `aplikasi` = '".$aplikasi."'");
		
		$getcekmax 	= $db->fetch_row($cekmax);
		
		$order 		= filter_int( $getcekmax[0] );
			
		$insert 	= $db->insert("sidebar_act",$data + compact('order'));
		
		if($insert) _e('<div id="success"><strong>SUCCESS</strong>: Sidebar berhasil ditambahkan.</div>');
	}
}

if(!function_exists('del_sidebar')){
	function del_sidebar($id){
		global $db;
		$db->delete("sidebar",compact('id'));
	}
}

if(!function_exists('del_action_sidebar')){
	function del_action_sidebar($data){
		global $db;
		$db->delete("sidebar_act",$data);
	}
}

if(!function_exists('list_app')){
	function list_app(){
	$app=array();
	$rep=opendir(App);
	while ($file = readdir($rep)) {
		if($file != '..' && $file !='.' && $file !=''){
			if ($file !='index.php' && $file !='index.html'){
				if (!is_dir($file)){
					if(file_exists(App.$file.'/'.$file.'.php')){
					 $r[]=$file;
					}
				}
			}
		}
	}
	return $r;
	}
}

if(!function_exists('filter_action_sidebar')){
	function filter_action_sidebar($data){
		extract($data, EXTR_SKIP);
		
		$aplikasi	= filter_txt( $aplikasi	);
		$posisi		= filter_int( $posisi	);
		
		$aplikasi	= esc_sql( $aplikasi	);
		$posisi		= esc_sql( $posisi		);
		
		$data = compact('aplikasi','posisi');
		return ($data);
	}
}

if(!function_exists('count_action_sidebar')){
	function count_action_sidebar($data){
		global $db;		
		$data 	= filter_action_sidebar($data);
		extract($data, EXTR_SKIP);
		
		$qry 	= $db->select("sidebar_act",$data);
		//$qry  = $db->query("SELECT COUNT(`id`) AS jumlah FROM `iw_sidebar_act` WHERE aplikasi='$aplikasi' AND posisi=0");
		return $db->num($qry);
	}
}

?>