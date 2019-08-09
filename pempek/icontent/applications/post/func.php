<?php
/**
 * @file func.php
 * 
 */
 
//not direct access
defined('_iEXEC') or die();

if(!function_exists('save_comment')){
	function save_comment($data){	
	global $db;	
		extract($data, EXTR_SKIP);
		
		$waiting_comment = '';
		if($approved    != 1) $waiting_comment ='<em>Your comment is awaiting moderation.</em><br>';
		
		$user = get_user_post();
		if($user['user_level']!='admin')
		posted('contact');
		
		if($db->insert('post_comment',$data)) 
		echo '<div class="div_info">Komentar berhasil. '.$waiting_comment.' </div>';
	}
}

if(!function_exists('filter_comment')){
	function filter_comment($data){
		extract($data, EXTR_SKIP);
		
		$author 		= esc_sql($author);
		$user_id		= esc_sql($user);
		$email 			= esc_sql($email);
		$comment 		= esc_sql($comment);
		$date 			= date('Y-m-d H:i:s');
		$date 			= esc_sql($date);
		$approved		= esc_sql($approved);
		$comment_parent	= esc_sql($reply);
		$post_id		= esc_sql($post_id);
		
		$data 		= compact('user_id','author','email','comment','date','approved','comment_parent','post_id');
		save_comment($data);
	}
}

if(!function_exists('get_user_post')){
	function get_user_post(){	
	global $session,$access;
	
	$user_login = $session->get('user_name');
	$field 		= $access->username_cek( compact('user_login') );

	return $field['row'];
	}
}

if(!function_exists('set_comment')){
	function set_comment($data){
		
		extract($data, EXTR_SKIP);
		
		if(!$author)  			 $error .= "Nama kosong<br />";
		if(!$email)  			 $error .= "Mail kosong<br />";
		if(!valid_mail($email))  $error .= "Format Mail salah<br />";		
		if(empty($comment))   	 $error .= "Isi Komentar kosong<br />"; 
		
		if($gfx_check != $_SESSION['Var_session'] or !isset($_SESSION['Var_session'])) $error .= "Code failed<br>";
		
		if(cek_post('comment')==1)
		$error .= 'Maaf anda sudah berkomentar, silahkan tunggu beberapa menit untuk berkomentar lagi.<br>';
		
		if($error){
			echo'<div class="div_alert">'.$error.'</div>';
		}else{						
			filter_comment($data);
		}
	}
}

if(!function_exists('post_user_login')){
	function post_user_login(){
		global $access;
		if(!$access->cek_login()) return false;
		else return true;
	}
}

if(!function_exists('count_comment')){
	function count_comment($id){
		global $db;
		
		$qry_comment			= $db->select("post_comment",array('post_id'=>$id,'approved'=>1,'comment_parent'=>0)); 
		$num1					= $db->num($qry_comment);
		$num2					= 0;
		while ($data			= $db->fetch_array($qry_comment)) {
			$no_comment 		= filter_int( $data['comment_id'] );
						
			$qry_comment2		= $db->select("post_comment",array('approved'=>1,'comment_parent'=>$no_comment)); 
			$num2				= $num2+$db->num($qry_comment2);
		}
		return $num1+$num2;	
		
	}
}

?>