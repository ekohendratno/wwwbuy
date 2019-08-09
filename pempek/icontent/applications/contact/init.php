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
				'link'  => '?admin&apps=contact'
				);
		$r[] = array(
				'title' => 'Inbox ('.count_inbox_msg().')',
				'link'  => '?admin&apps=contact&act=inbox'
				);
		$r[] = array(
				'title' => 'Send Item ('.count_outbox_msg().')',
				'link'  => '?admin&apps=contact&act=senditem'
				);
		$r[] = array(
				'title' => 'New Message',
				'link'  => '?admin&apps=contact&go=new'
				);
		return $r;
	}
}

if(!function_exists('set_name_mail')){
	function set_name_mail($string){
		if(preg_match('/^([a-z0-9])(([-a-z0-9._])*([a-z0-9]))*\@([a-z0-9])' .
'(([a-z0-9-])*([a-z0-9]))+' . '(\.([a-z0-9])([-a-z0-9_-])?([a-z0-9])+)+$/i',$string)) $pilah = explode('@',$string);
		return $pilah[0];
	}
}

if(!function_exists('del_contact_message')){
	function del_contact_message($data){
		global$db;
		$db->delete("contact",$data);
	}
}

if(!function_exists('send_contact_message')){
	function send_contact_message($data){
		global $db;
		$db->update("contact",$data,$where);
	}
}

if(!function_exists('last_read_message')){
	function last_read_message($data,$where){
		global $db;
		$db->update( "contact",$data, $where ); 
	}
}

if(!function_exists('update_resend_message')){
	function update_resend_message($data,$where){
		global $db;
		$error = array();
		if (!valid_mail($data['email'])) $error[] = "Email not valid<br />";
		if (!$data['subject']){  	$error[] = "Subject empty<br />";}
		if (!$data['message']){  	$error[] = "Message empty<br />";}
		if ($error) {
			foreach($error as $key){
			echo '<div id="error">'.$key.'</div>';
			}
		} else {
			mail_send($mailmaster, $data['email'], $data['subject'], $data['message'], 1, 1);
			$db->update( "contact",$data, $where ); 
			echo'<div id="success">Success send message</div>';
		}
	}
}

if(!function_exists('insert_send_message')){
	function insert_send_message($data){
		global $db;
		$error = array();
		if (!valid_mail($data['email'])) $error[] = "Email not valid<br />";
		if (!$data['subject']){  	$error[] = "Subject empty<br />";}
		if (!$data['message']){  	$error[] = "Message empty<br />";}
		if ($error) {
			foreach($error as $key){
			echo '<div id="error">'.$key.'</div>';
			}
		} else {
			mail_send($mailmaster, $data['email'], $data['subject'], $data['message'], 1, 1);
			$db->insert( "contact",$data ); 
			echo'<div id="success">Success send message</div>';
		}
	}
}


