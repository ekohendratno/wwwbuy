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
				'link'  => '?admin&amp;sys=users'
				);
		return $r;
	}
}

if(!function_exists('gadget')){
	function gadget(){
		global $iw,$db;
		$r 	 = array();
		$r['title'] = 'New User';
		$q_select	= $db->select("users",null,'ORDER BY user_registered DESC LIMIT 10');
		while($row=$db->fetch_array($q_select)){
			$show  .= '<img title="'.$row['user_login'].'" alt="" src="'.get_gravatar($row['user_email']).'" height="30" width="30" style="margin:1px;cursor:pointer;">';
		}
		$r['desc']  = $show;
		return $r;
	}
}

if(!function_exists('gadget2')){
	function gadget2(){
		global $iw,$db;
		$r 	 = array();
		$r['title'] = 'Last Update';
		$q_select	= $db->select("users",array('user_status'=>1),'ORDER BY user_last_update DESC LIMIT 10');
		while($row=$db->fetch_array($q_select)){
			$show  .= '<img title="'.$row['user_login'].'" alt="" src="'.get_gravatar($row['user_email']).'" height="30" width="30" style="margin:1px;cursor:pointer;">';
		}
		$r['desc']  = $show;
		return $r;
	}
}

if(!function_exists('del_users')){
	function del_users($id){
		global $iw,$db;
		$ID = esc_sql($id);
		$db->delete("users",compact('ID'));
		$db->delete("users_data",compact('ID'));
	}
}

if(!function_exists('change_password')){
	function change_password($data){
		global $iw,$db,$access;		
		extract($data, EXTR_SKIP);
		
		$ID 		= esc_sql($user_id);
		$newpass	= esc_sql($newpass);
		$old_pass	= esc_sql($oldpass);
		$repass		= esc_sql($repass);
		
		$oldpass	= md5($oldpass);
		$user_pass	= md5($newpass);
		
		if(empty($newpass) || empty($repass)) $msg[] = '<strong>ERROR</strong>: New & Re Password is empty</a>';
		
		if($newpass !== $repass) $msg[] = '<strong>ERROR</strong>: Invalid New Password & Re Password not match</a>';
		
		$field = $access->username_cek( compact('ID') );
		if($field['row']['user_pass'] !== $oldpass) $msg[] = '<strong>ERROR</strong>: Invalid Old Password not match</a>';
		
		if( is_array($msg))	{
			foreach($msg as $val){
				_e('<div id="error">'.$val.' </div>');
			}
		}
		if(empty($msg)){
			$update = $access->change_password(compact('user_pass'),compact('ID'));
			if($update) _e('<div id="success">The Password success to change</div>');
		}
	}
}


