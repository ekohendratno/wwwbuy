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
				'title' => 'General',
				'link'  => '?admin&amp;sys=options'
				);
		$r[] = array(
				'title' => 'Privacy',
				'link'  => '?admin&amp;sys=options&go=privacy'
				);
		$r[] = array(
				'title' => 'Setting',
				'link'  => '?admin&amp;sys=options&go=setting'
				);
		$r[] = array(
				'title' => 'Avatar',
				'link'  => '?admin&amp;sys=options&go=avatar'
				);
		$r[] = array(
				'title' => 'Quick Links',
				'link'  => '?admin&amp;sys=options&go=quick-links'
				);
		return $r;
	}
}

if(!function_exists('gadget')){
	function gadget(){
		$r 	 = array();
		$r['title'] = 'Info';
		$r['desc']  = '
		<p><span class="dr">General</span>yang memungkinkan mengganti judul, email maupun deskription meta pada website, sekaligus mengatur zona waktu yang dipakai di negara tsb.</p>
		<p><span class="dr">Privacy</span>yang memungkinkan mengatur hak privasi untuk situs anda, seperti web registration, author name sampai masalah copyright dan lain-lain</p>
		<p><span class="dr">Setting</span>yang memungkinkan mengatur setting untuk situs anda terutama pada backend</p>
		<p><span class="dr">Permalinks</span>yang memungkinkan anda mengatur atau mengganti bentuk maupun struktur url website</p>
		<p><span class="dr">Quick Links</span>yang memungkinkan anda mengatur atau mengganti ganti quick links</p>
		';
		return $r;
	}
}

if(!function_exists('save_options')){
	function save_options($data){

		if ( ! is_array( $data ) )
			return false;
		
		$run = array();
		foreach ( (array) array_keys( $data ) as $name ) {
			$run[] = set_option($name,$data[$name]);
		}
		return $run;
		
	}
}


if(!function_exists('set_general')){
	function set_general($data){
		extract($data, EXTR_SKIP);
		
		$msg = array();
		if(empty($web_title)) 	$msg[] ='<strong>ERROR</strong>: The title is empty.';
		if(empty($web_slogan)) 	$msg[] ='<strong>ERROR</strong>: The slogan is empty.';
		if(empty($meta_desc)) 	$msg[] ='<strong>ERROR</strong>: The description is empty.';
		if(empty($meta_key)) 	$msg[] ='<strong>ERROR</strong>: The meta keywords is empty.';
		if(empty($admin_email)) $msg[] ='<strong>ERROR</strong>: The e-mail address is empty.';
		if(empty($timezone)) 	$msg[] ='<strong>ERROR</strong>: The timezone is empty.';
		if(empty($datetime_format)) $msg[] ='<strong>ERROR</strong>: The datetime format is empty.';
		
		if($msg){
			foreach($msg as $error) _e('<div id="error">'.$error.'</div>');
		}else{
			if(save_options($data)) _e('<div id="success"><strong>SUCCESS</strong>: Opsi General berhasil di perbaharui</div>');
		}
	}
}

if(!function_exists('set_privacy')){
	function set_privacy($data){
		extract($data, EXTR_SKIP);
		
		$msg = array();
		if(empty($author)) 	$msg[] ='<strong>ERROR</strong>: The author is empty.';
		
		if($msg){
			foreach($msg as $error) _e('<div id="error">'.$error.'</div>');
		}else{
			if(save_options($data)) _e('<div id="success"><strong>SUCCESS</strong>: Opsi Privacy berhasil di perbaharui</div>');
		}
	}
}

if(!function_exists('set_setting')){
	function set_setting($data){
		extract($data, EXTR_SKIP);
		if(save_options($data)) _e('<div id="success"><strong>SUCCESS</strong>: Opsi Setting berhasil di perbaharui</div>');
	}
}

if(!function_exists('set_avatar')){
	function set_avatar($data){
		extract($data, EXTR_SKIP);
		if(save_options($data)) _e('<div id="success"><strong>SUCCESS</strong>: Opsi Avatar berhasil di perbaharui</div>');
	}
}

if(!function_exists('set_quick_links')){
	function set_quick_links($data){
		extract($data, EXTR_SKIP);
		
		$msg = array();
		if(empty($title)) 	$msg[] ='<strong>ERROR</strong>: The title is empty.';
		if(empty($type)) 	$msg[] ='<strong>ERROR</strong>: The type not field select.';
		if(empty($url)) 	$msg[] ='<strong>ERROR</strong>: The link path is empty.';
		
		if($msg){
			foreach($msg as $error) _e('<div id="error">'.$error.'</div>');
		}else{
			$QpA 	= get_option('qlinks');
			if($type==1) $type=1;
			if($type==2) $type=2;
			if($type==3) $type=3;
			else $type=0;
			
			$row	= $QpA.'#'.$title.'::'.$type.'::'.$url;
			
			$data   = array('qlinks'=>$row ); 
			if(save_options($data)) _e('<div id="success"><strong>SUCCESS</strong>: Opsi Quick Links berhasil di ditambahkan</div>');
		}
	}
}

if(!function_exists('update_qlink_options')){
	function update_qlink_options($data){
	if ( ! is_array( $data ) )
			return false;
	
	$error = array();
	foreach($data['title'] as $key=>$val){
		if($data['type'][$key] == 1)$type =1;
		elseif($data['type'][$key] == 2)$type =2;
		elseif($data['type'][$key] == 3)$type =3;
		else $type =0;
		
		if(empty($val)) 	$msg[] ='<strong>ERROR</strong>: The title '.$key.' is empty.'; 
	
		$row .= $val.'::'.$type.'::'.$data['url'][$key].'#';
	}
	
	if($msg){
		foreach($msg as $error) _e('<div id="error">'.$error.'</div>');
	}else{
		$row  = substr_replace($row, "", -1, 1);
		$data = array('qlinks'=>$row ); 
		if(save_options($data)) _e('<div id="success"><strong>SUCCESS</strong>: Opsi Quick Links berhasil di perbaharui</div>');
	}
	
	}
}

if(!function_exists('del_quick_links')){
	function del_quick_links($id){
		$id = esc_sql($id);
		$QpA 	= get_option('qlinks');
		$QpB 	= explode('#',$QpA);
		foreach($QpB as $key=>$val){
			if($key!=$id) $row.= $val.'#';
		}
		$row  = substr_replace($row, "", -1, 1);
		$data = array('qlinks'=>$row ); 
		if(save_options($data)):
			redirect('?admin&sys=options&go=quick-links');
		endif;
	}
}

?>