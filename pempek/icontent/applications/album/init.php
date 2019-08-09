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
				'link'  => '?admin&apps=album'
				);
		$r[] = array(
				'title' => 'Category',
				'link'  => '?admin&apps=album&to=cat'
				);
		return $r;
	}
}

if(!function_exists('del_foto')){
	function del_foto($id){
		global $db;
		$r = $db->fetch_obj( $db->select("album",compact('id')) );
		
		if(file_exists(Upload.'albums/'.$r->image)){
			@unlink(Upload.'albums/'.$r->image);  
		}   
		
		$db->delete("album",compact('id'));
	}
}

if(!function_exists('update_foto')){
	function update_foto($data,$id){
		global $db;
		$db->update("album",$data,compact('id'));
	}
}

if(!function_exists('del_album')){
	function del_album($id){
		global $db;
		$db->delete("album_cat",compact('id'));
	}
}

if(!function_exists('update_album')){
	function update_album($data,$id){
		global $db;
		$db->update("album_cat",$data,compact('id'));
	}
}

if(!function_exists('insert_album')){
	function insert_album($data){
		global $iw,$db;		
		$insert 	= $db->insert("album_cat",$data);		
		if($insert) _e('<div id="success"><strong>SUCCESS</strong>: Category Album berhasil ditambahkan.</div>');
	}
}

if(!function_exists('upload_img_foto')){
	function upload_img_foto($thumb){
		global $iw;
		if(!empty($thumb['name'])):
			
		$myfile 	 = $thumb; //image name
		$uploadDir 	 = Upload.'albums/'; //directory upload file
		$data_upload = compact('myfile','uploadDir');
			
		if( function_exists('uploader') ) :
		if( in_array($thumb['type'],array_keys($iw->image_allaw)) ):
			
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

if(!function_exists('insert_foto')){
	function insert_foto($data){
		extract($data, EXTR_SKIP);
		
		$msg = array();
		if( empty($title) ) $msg[] ='<strong>ERROR</strong>: The title is empty.';		
		if( empty($desc) )  $msg[] ='<strong>ERROR</strong>: The desc is empty.';		
		if( empty($cat) )   $msg[] ='<strong>ERROR</strong>: The category is empty.';		
		if( empty($thumb) ) $msg[] ='<strong>ERROR</strong>: The file thumb image is empty.';		
		
		if( $msg ){
			foreach($msg as $error) 
			_e('<div id="error">'.$error.'</div>');
		}
		else
		{
			if($thumb){
			//upload image
			upload_img_foto($thumb);
			}
			$image 	= filter_txt( $thumb['name'] );
			$data 	= compact('title','desc','cat','image');
			//saving data to database
			if(save_foto($data)) 
			_e('<div id="success"><strong>SUCCESS</strong>: Foto berhasil di tambahkan</div>');
		}
			
	}
}

if(!function_exists('save_foto')){
	function save_foto($data){
		global $db,$session; 
		extract($data, EXTR_SKIP);
		
		$title 		= esc_sql($title);
		$desc 		= esc_sql($desc);
		$cat		= esc_sql($cat);
		$image 		= esc_sql($image);	
		$date		= date('Y-m-d H:i:s');	
		$user_login	= esc_sql($session->get('user_name'));	
		
		$data = compact('user_login','title','desc','cat','image','date');
		return $db->insert('album',$data);
	}
}

if(!function_exists('gadget_foto')){
	function gadget_foto($id){
		global $iw,$db;
		$r 	 = array();
		$r['title'] = 'Current Foto';
		$row 		= view_foto( $id );
		$r['desc']  = '<div style="text-align:center;"><img style="border:1px solid #ddd; padding:5px; min-height:160px; min-width:160px" src="'. $iw->base_url. 'irequest.php?load=thumb&app=album&src='.$row->image.'&x=160&y=160&c=1"><br>'.$row->title.'</div>';
		return $r;
	}
}

if(!function_exists('edit_foto')){
	function edit_foto($data,$id){
		global $db, $session; 
		extract($data, EXTR_SKIP);
		
		$title 		= esc_sql($title);
		$desc		= esc_sql($desc);
		$cat 		= esc_sql($cat);
		$thumb		= esc_sql($thumb);
		$date		= date('Y-m-d H:i:s');
		
		$msg = array();
		if( empty($title) ) $msg[] ='<strong>ERROR</strong>: The title is empty.';		
		if( empty($desc) )  $msg[] ='<strong>ERROR</strong>: The desc is empty.';		
		if( empty($cat) )   $msg[] ='<strong>ERROR</strong>: The category is empty.';		
		if( empty($thumb) ) $msg[] ='<strong>ERROR</strong>: The file thumb image is empty.';	
		
		if( $msg ){
			foreach($msg as $error) 
			_e('<div id="error">'.$error.'</div>');
		}
		else
		{
		
			$row 		= view_foto( $id );
			if(!empty($thumb['name'])):
			upload_img_foto($thumb);
			
			del_img_foto($row->image);
			$image 		= esc_sql($thumb['name']);
			else:
			$image		= esc_sql($row->image);
			endif;
		
			$data 	= compact('title','desc','cat','image','date');
		
			//saving data to database
			if(update_foto($data,$id)) 
			_e('<div id="success"><strong>SUCCESS</strong>: Foto berhasil di tambahkan</div>');
		}
	}
}

if(!function_exists('view_foto')){
	function view_foto($id){
		global $db;
		$q	 = $db->select("album",compact('id'));
		return $db->fetch_obj($q);
	}
}

if(!function_exists('view_album')){
	function view_album($id){
		global $db;
		$q	 = $db->select("album_cat",compact('id'));
		return $db->fetch_obj($q);
	}
}

if(!function_exists('del_img_foto')){
	function del_img_foto($file){
		
		$path = Upload.'albums/';
		if(!empty($file)):
		if(file_exists($path.$file))
			unlink($path.$file);
		endif;
	}
}
