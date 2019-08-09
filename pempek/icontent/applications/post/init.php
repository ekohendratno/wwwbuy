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
				'title' => 'Articles',
				'link'  => '?admin&apps=post'
				);
		$r[] = array(
				'title' => 'Pages',
				'link'  => '?admin&apps=post&type=page'
				);
		$r[] = array(
				'title' => 'Category',
				'link'  => '?admin&apps=post&go=category'
				);
		$r[] = array(
				'title' => 'Comment',
				'link'  => '?admin&apps=post&go=comment'
				);
		$r[] = array(
				'title' => 'Setting',
				'link'  => '?admin&apps=post&go=setting'
				);
		return $r;
	}
}


if(!function_exists('del_img_post')){
	function del_img_post($file){
		
		$path = Upload.'post/';
		if(!empty($file)):
		if(file_exists($path.$file))
			unlink($path.$file);
		endif;
	}
}

if(!function_exists('view_category_post')){
	function view_category_post($id){
		global $db;
		$q	 = $db->select("post_topic",compact('id'));
		return $db->fetch_array($q);
	}
}

if(!function_exists('view_post')){
	function view_post($id){
		global $db;
		$q	 = $db->select("post",compact('id'));
		return $db->fetch_array($q);
	}
}

if(!function_exists('list_category')){
	function list_category($id=null){
		global $db;
		$q		    = $db->select("post_topic");
		while($row 	= $db->fetch_array($q)){
			if(!empty($id) && $row['id'] == $id)
				echo '<option value="'.$row['id'].'" selected="selected">'.$row['topic'].'</option>'."\n";
			else
				echo '<option value="'.$row['id'].'">'.$row['topic'].'</option>'."\n";
		}
	}
}

if(!function_exists('save_post')){
	function save_post($data){
		global $db,$session,$access; 
		extract($data, EXTR_SKIP);
		
		$title 		= esc_sql($title);
		$type 		= esc_sql($type);
		$post_topic	= esc_sql($category);
		$tags 		= esc_sql($tags);
		$content	= esc_sql($isi);
		$thumb 		= esc_sql($thumb['name']);
		$date_post	= esc_sql($date);
		$date_modif	= esc_sql($date);
		$date_update= esc_sql($date);
		
		$seo 		= new engine;
		$sefttitle	= esc_sql($seo->judul($title));
		$user_login	= esc_sql($session->get('user_name'));		
		$row 		= $access->username_cek( compact('user_login') );
		$mail		= esc_sql($row['row']['user_email']);
		
		$data = compact('user_login','title','sefttitle','post_topic','mail','type','content','thumb','tags','date_post','date_modif','date_update');
		return $db->insert('post',$data);
	}
}

if(!function_exists('update_save_post')){
	function update_save_post($data,$id){
		global $db, $session; 
		extract($data, EXTR_SKIP);
		
		$title 		= esc_sql($title);
		$post_topic	= esc_sql($category);
		$tags 		= esc_sql($tags);
		$content	= esc_sql($isi);
		$date_modif	= esc_sql($date);
		
		$row 		= view_post( $id );
		if(!empty($thumb['name'])):
		upload_img_post($thumb);
		
		del_img_post($row['thumb']);
		$thumb 		= esc_sql($thumb['name']);
		else:
		$thumb		= esc_sql($row['thumb']);
		endif;
		
		$seo 		= new engine;
		$sefttitle	= esc_sql($seo->judul($title));
		$user_login = esc_sql($session->get('user_name'));
		
		$data = compact('user_login','title','sefttitle','post_topic','content','thumb','tags','date_modif');
		$where= compact('id');
		return $db->update('post',$data,$where);
	}
}

if(!function_exists('update_pub_post')){
	function update_pub_post($data,$id){
		global $db; 				
		$where = compact('id');
		return $db->update('post',$data,$where);
	}
}

if(!function_exists('upload_img_post')){
	function upload_img_post($thumb){
		global $iw;
		if(!empty($thumb['name'])):
			
		$myfile 	 = $thumb; //image name
		$uploadDir 	 = Upload.'post/'; //directory upload file
		$data_upload = compact('myfile','uploadDir');
			
		if(function_exists('uploader')) :
		if ( in_array($thumb['type'],array_keys($iw->image_allaw)) ):
			
		//upload file function
		if(uploader($data_upload)):
			
		$path 	 = $uploadDir.$thumb['name']; // dir & name path image for upload
		$type 	 = $iw->image_allaw[$thumb['type']]; //type image is allow
		$resize  = 650; // size for resize image
		$quality = 80; // quality 80%
			
		$data_resize = compact('path','type','resize','quality');
		//resize if file is image allaw function
		if(function_exists('resize_image'))
		resize_image($data_resize);
		endif;
		endif;
		endif;
		endif;
	}
}

if(!function_exists('add_post')){
	function add_post($data){
		extract($data, EXTR_SKIP);
		
		$msg = array();
		if(empty($title)) $msg[] ='<strong>ERROR</strong>: The title is empty.';
		
		if(!empty($type) && $type=='post' )
		if( empty($category) ) $msg[] ='<strong>ERROR</strong>: The category is empty.';
			
		if( empty($type) ) $msg[] ='<strong>ERROR</strong>: The type not select.';		
		if( empty($date) ) $msg[] ='<strong>ERROR</strong>: The date is empty.';
		
		if( $msg ){
			foreach($msg as $error) 
			_e('<div id="error">'.$error.'</div>');
		}
		else
		{
			if($thumb){
			//upload image
			upload_img_post($thumb);
			}
			//saving data to database
			if(save_post($data)) 
			_e('<div id="success"><strong>SUCCESS</strong>: Posting berhasil di tambahkan</div>');
		}
			
	}
}

if(!function_exists('update_post')){
	function update_post($data,$id){
		extract($data, EXTR_SKIP);
		
		$msg = array();
		if(empty($title)) 	$msg[] ='<strong>ERROR</strong>: The title is empty.';
		
		if(!empty($type) && $type=='post')
		if(empty($category))$msg[] ='<strong>ERROR</strong>: The category is empty.';
		
		if(empty($date)) 	$msg[] ='<strong>ERROR</strong>: The date is empty.';
		
		if($msg){
			foreach($msg as $error) _e('<div id="error">'.$error.'</div>');
		}
		else
		{
			if(update_save_post($data,$id)) 
			_e('<div id="success"><strong>SUCCESS</strong>: Posting berhasil di perbaharui</div>');
		}
			
	}
}

if(!function_exists('save_category_post')){
	function save_category_post($data){
		global $db; 
		
		extract($data, EXTR_SKIP);
		
		$topic 		= esc_sql($title);
		$desc 		= esc_sql($desc);
		
		$data = compact('topic','desc');
		return $db->insert('post_topic',$data);
	}
}

if(!function_exists('add_category_post')){
	function add_category_post($data){
		extract($data, EXTR_SKIP);
		
		if(empty($title)) 	$msg ='<strong>ERROR</strong>: The title is empty.';
		
		if($msg){
			_e('<div id="error">'.$msg.'</div>');
		}else{
			if(save_category_post($data)) _e('<div id="success"><strong>SUCCESS</strong>: Category Post berhasil di tambahkan</div>');
		}
			
	}
}

if(!function_exists('update_save_category_post')){
	function update_save_category_post($data,$id){
		global $db; 
		
		extract($data, EXTR_SKIP);
		
		$topic 		= esc_sql($title);
		$desc 		= esc_sql($desc);
		
		$data = compact('topic','desc');
		return $db->update('post_topic',$data,compact('id'));
	}
}

if(!function_exists('update_category_post')){
	function update_category_post($data,$id){
		extract($data, EXTR_SKIP);
		
		if(empty($title)) 	$msg ='<strong>ERROR</strong>: The title is empty.';
		
		if($msg){
			_e('<div id="error">'.$msg.'</div>');
		}else{
			
			if(update_save_category_post($data,$id)) 
			_e('<div id="success"><strong>SUCCESS</strong>: Category Post berhasil di perbaharui</div>');
		}
			
	}
}

if(!function_exists('del_post')){
	function del_post($data){
		global $db;
		
		$id  = $data['id'];
		$row = view_post( $id );
				
		del_img_post($row['thumb']);
		$db->delete("post",$data);
	}
}

if(!function_exists('del_category_post')){
	function del_category_post($data){
		global $db;
		$db->delete("post_topic",$data);
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

if(!function_exists('set_posting')){
	function set_posting($data){
		extract($data, EXTR_SKIP);
		
		if(save_options($data)) 
		_e('<div id="success"><strong>SUCCESS</strong>: Setting Posting berhasil di perbaharui</div>');
	}
}

if(!function_exists('update_comment')){
	function update_comment($data,$where){
		global $db;
		
		$db->update("post_comment",$data,$where);
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
		global $db;
		extract($data, EXTR_SKIP);
		
		$comment 		= esc_sql($comment);
		$post_id 		= esc_sql($id);
		$comment_parent	= esc_sql($reply);
		
		$user		= get_user_post();
		$author		= esc_sql($user['user_author']);
		$user_id	= esc_sql($user['user_login']);
		$email		= esc_sql($user['user_email']);
		$date		= date('Y-m-d H:i:s');
		
		if(empty($comment)) 	$msg ='<strong>ERROR</strong>: The comment is empty.';
		
		if($msg) _e('<div id="error">'.$msg.'</div>');
		else
		{
			$data = compact('comment','post_id','comment_parent','author','user_id','email','date');
			if($db->insert("post_comment",$data))
			_e('<div id="success"><strong>SUCCESS</strong>: Reply comment</div>');
		}
		
	}
}

if(!function_exists('del_comment')){
	function del_comment($data){
		global $db;
		
		$db->delete("post_comment",$data);
	}
}