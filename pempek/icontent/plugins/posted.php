<?php
/**
 * @file: posted.php
 * @type: plugin
 */
/*
Plugin Name: Posted
Plugin URI: http://cmsid.org/#
Description: Plugin yang dibutuhkan untuk menunjang kinerja / performa application post.
Author: Eko Azza
Version: 1.1.0
Author URI: http://cmsid.org/
*/ 
//not direct access
defined('_iEXEC') or die();

if(!function_exists('tags')){
	function tags($id=false){
		global $db;
		if(!empty($id)){
			$where = array('type'=>'post','id'=>$id);
		}else{	
			/*	
			$query_add = '';
			global $session;
			if($access->cek_login()){
			if($_GET['com']=='post' && $_GET['view']=='item'){
				$query_add='WHERE user_login='.$session->get('user_name').'';
			}
			*/
			$where = array('type'=>'post','status'=>1);
		}
		$qry 	= $db->select('post',$where);
		$jum 	= $db->num($qry);
		if($jum <1 ){
		_e('tidak ada tags');
		}else{
		$TampungData = array();
		while ($data_tags = $db->fetch_array($qry)) {
			$tags = explode(',',strtolower(trim($data_tags['tags'])));
			foreach($tags as $val) {
						$TampungData[] = $val;
						
				}
		}
	
		$totalTags = count($TampungData);
		$jumlah_tag = array_count_values($TampungData);
		ksort($jumlah_tag);
		if ($totalTags > 0) {
		$output = array();
		$tag_mod = array();
		$tag_mod['fontsize']['max'] = 20;
		$tag_mod['fontsize']['min'] = 9;
	
		$min_count = min($jumlah_tag);
		$spread = max($jumlah_tag) - $min_count;
		if ( $spread <= 0 )
			$spread = 1;
		$font_spread = $tag_mod['fontsize']['max'] - $tag_mod['fontsize']['min'];
		if ( $font_spread <= 0 )
			$font_spread = 1;
		$font_step = $font_spread / $spread;
		
		foreach($jumlah_tag as $key=>$val) {
		$font_size = ( $tag_mod['fontsize']['min'] + ( ( $val - $min_count ) * $font_step ) );
		$datas = array('view'=>'tags','id'=>urlencode($key));
		$output[] = "<a href='".do_links("post",$datas)."' style='font-size:".$font_size."px'>".$key ."</a>";
		}
		return $output;
		}}
	}
}

if(!function_exists('load_meta_news')){
	function load_meta_news($title,$desc,$key){
		$GLOBALS['title']		= $title;
		$GLOBALS['desc'] 		= limittxt(htmlentities(strip_tags($desc)),320);
		$GLOBALS['key'] 		= empty($key) ? implode(',',explode(' ',htmlentities(strip_tags($title)))) : $key;
	}
}

if(!function_exists('post_item_id')){
	function post_item_id($act,$id){
		global $db;
		$engine =  new engine;
		if( $engine->no() == 4 || $engine->no() == 5 ):
		$selftitle = filter_clear($id);
		
		if( $act == 'page' ){
			$q = $db->select("post", array('type'=>'page','status'=>1));
			while($data 	= $db->fetch_array($q)){
			if($data['sefttitle'] == $selftitle){
				$id = $data['id'];
			}}
		}
		elseif( $act == 'item' ){
			$q				= $db->select("post", array('type'=>'post','status'=>1));
			while($data 	= $db->fetch_array($q)){
				if($data['sefttitle'] == $selftitle){
					$id = $data['id'];
			}}
		}
		elseif( $act == 'category' ){
			$q				= $db->select("post_topic");
			while($data 	= $db->fetch_array($q)){
				if($engine->judul($data['topic']) == $selftitle){
					$id=$data['id'];
			}}
		}
		endif;
		return filter_int( $id );
	}
}