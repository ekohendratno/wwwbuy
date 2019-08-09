<?php
/**
 * @file: seo.php
 * @type: plugin
 */
/*
Plugin Name: SEO
Plugin URI: http://cmsid.org/#
Description: Plugin Search Engine User Frendly.
Author: Eko Azza
Version: 1.1.0
Author URI: http://cmsid.org/
*/ 
//not direct access
defined('_iEXEC') or die();

function get_uri(){
	$return = str_replace(''.$_SERVER['PHP_SELF'].'','/',$_SERVER['REQUEST_URI']);
	return $return;
}

function start_uri_perse(){
	// N/A = tidak diketahui
	
	//?com_N/A=view_N/A&id_N/A:N/A
	$uri = get_uri();
	if($uri && !empty($uri)){
		
	$get 		= array('com','view','id','cat_id','offset','title');
	//?com_N/A=view_N/A&id_N/A:N/A
	$expl1 		= explode('?',$uri);
	//com_N/A=view_N/A&id_N/A:N/A
	$expl2		= explode(':',$expl1[1]);
	//com_N/A=view_N/A&id_N/A
	$expl3		= explode('&',$expl2[0]);
	
	/* com_N/A=view_N/A
	 * id_N/A
	 **/
	if(!empty($expl2[0])):
	foreach($expl3 as $key){
		/* com_N/A
		 * view_N/A
		 * id_N/A
		 **/
		$expl4	= explode('=',$key);
		foreach($expl4 as $keys){
			/* com
			 * N/A
			 * view
			 * N/A
			 * id
			 * N/A
			 **/
			$expl5	= explode('_',$keys);
			
			if(!empty($expl1[1])){
				if(in_array($expl5[0],$get))
				if(!(int)$expl1[1])
				$_GET[$expl5[0]] = filter_txt($expl5[1]);
				else
				$_GET[$expl5[0]] = filter_int($expl5[1]);
			}
		}
	}
	endif;	
	}
}

function create_rewrite($content){
	$file = fopen(".htaccess", "w");
	fwrite($file,$content);
	fclose($file);
}

function del_rewrite(){
	$file = abs_path.'.htaccess';
	if(file_exists($file))
	unlink($file);
}

function head_rewrite(){
	$base_dir = dirname($_SERVER["SCRIPT_NAME"]);
	$base_dir = filter_txt($base_dir);
	return '
	<IfModule mod_rewrite.c> 
	Options -MultiViews
	Options +FollowSymlinks
	RewriteEngine On
	RewriteBase '.$base_dir.'
	';
}

function foot_rewrite(){		
	return '
	</IfModule>
	<Files ~ "^.*\.([Hh][Tt][Aa])">
	order allow,deny
	deny from all
	satisfy all
	</Files>
	';
}

function load_plugin_link($app,$data=null){
	$engine = new engine;
	$type 	= '.html';
	$head 	= head_rewrite();			
	$foot 	= foot_rewrite();
	
	if(!empty($data)):
	if(!is_array($data))
	return false;
		
	extract($data, EXTR_SKIP);
	endif;
	
	$link = '';
	
	if($engine->no()==2):
	/*
	 * Type: Advance-Type
	 * Number: 1
	 */	
	 start_uri_perse();
	 
	 if(!empty($title)) $title = ':'.$engine->judul($title);
	 else $title = '';
	 
		if(!empty($offset) && !empty($cat_id) && !empty($id) && !empty($view)):
			//?com=N/A&view=N/A&cat_id=N/A&id=N/A&offset=N/A
			$link = '?com_'.$app.'=view_'.$view.'&cat_id_'.$cat_id.'=id_'.$id.'&offset_'.$offset.$title; 
		elseif(!empty($offset) && !empty($id) && !empty($view)):
			//?com=N/A&view=N/A&id=N/A&offset=N/A
			$link = '?com_'.$app.'=view_'.$view.'&id_'.$id.'=offset_'.$offset.$title; 
		elseif(!empty($offset) && !empty($view)):
			//?com=N/A&view=N/A&offset=N/A
			$link = '?com_'.$app.'=view_'.$view.'&offset_'.$offset.$title; 
		elseif(!empty($cat_id) && !empty($id) && !empty($view)):
			//?com=N/A&view=N/A&cat_id=N/A&id=N/A
			$link = '?com_'.$app.'=view_'.$view.'&cat_id_'.$cat_id.'=id_'.$id.$title; 
		elseif(!empty($id) && !empty($view)):
			//?com=N/A&view=N/A&id=N/A
			$link = '?com_'.$app.'=view_'.$view.'&id_'.$id.$title; 
		elseif(!empty($id)):
			//?com=N/A&id=N/A
			$link = '?com_'.$app.'=id_'.$id.$title; 
		elseif(!empty($view)):
			//?com=N/A&view=N/A
			$link = '?com_'.$app.'=view_'.$view.$title; 
		else:
			//?com=N/A
			$link = '?com_'.$app; 
		endif;
	del_rewrite();
	
	elseif($engine->no()==3):
	
	if(!empty($title)) $title = $engine->judul($title);
	else $title = '';
	 
		if(!empty($offset) && !empty($cat_id) && !empty($id) && !empty($view)):
			//com/view/cat_id/id/offset/title.type; 
			$link = $app.'/'.$view.'/'.$cat_id.'/'.$id.'/'.$offset.'/'.$title.$type; 
		elseif(!empty($offset) && !empty($id) && !empty($view)):
			//com/view/id/offset/title.type; 
			$link = $app.'/'.$view.'/'.$id.'/'.$offset.'/'.$title.$type;  
		elseif(!empty($offset) && !empty($view)):
			//com/view/offset/title.type; 
			$link = $app.'/'.$view.'/'.$offset.'/'.$title.$type;   
		elseif(!empty($cat_id) && !empty($id) && !empty($view)):
			//com/view/cat_id/id/title.type; 
			$link = $app.'/'.$view.'/'.$cat_id.'/'.$id.'/'.$title.$type;  
		elseif(!empty($id) && !empty($view)):
			//com/view/id/title.type; 
			if($view!='tags')
			$link = $app.'/'.$view.'/'.$id.'/'.$title.$type; 
			else
			$link = $app.'/'.$view.'/'.$engine->judul($id).$type; 
		elseif(!empty($id)):
			//com/id/title.type; 
			$link = $app.'/'.$id.'/'.$title.$type;  
		elseif(!empty($view)):
			//com/view.type; 
			$link = $app.'/'.$view.$type;  
		else:
			//com.type; 
			$link = $app.$type; 
		endif;
		$htaccess = $head.'		
		RewriteRule ^([a-zA-Z0-9_-]+)(\.html)?$ index.php?com=$1
		RewriteRule ^([a-zA-Z0-9_-]+)/([a-zA-Z0-9_-]+)(\.html)?$ index.php?com=$1&view=$2
		RewriteRule ^([a-zA-Z0-9_-]+)/([0-9]+)/([a-zA-Z0-9_-]+)(\.html)?$ index.php?com=$1&id=$2
		RewriteRule ^([a-zA-Z0-9_-]+)/([a-zA-Z0-9_-]+)/([a-zA-Z0-9_-]+)(\.html)?$ index.php?com=$1&view=$2&id=$3
		RewriteRule ^([a-zA-Z0-9_-]+)/([a-zA-Z0-9_-]+)/([0-9]+)/([a-zA-Z0-9_-]+)(\.html)?$ index.php?com=$1&view=$2&id=$3
		'.$foot;	
		create_rewrite($htaccess);
		
	elseif($engine->no()==4):
	
	if(!empty($title)) $title = $engine->judul($title);
	else $title = '';
	 
	
	if($app=='post'):
		if(!empty($cat_id) && !empty($id) && !empty($view)):
			//view/cat_id/title.type; 
			$link = $view.'/'.$cat_id.'/'.$title.$type;  
		elseif(!empty($id) && !empty($view) && !empty($pg)): 
			$link = $view.'/'.$id.'/pg/'.$pg.$type; 
		elseif(!empty($id) && !empty($view)):
			//view/title.type; 
			if($view!='tags')
			$link = $view.'/'.$title.$type; 
			else
			$link = $view.'/'.$engine->judul($id).$type; 
		elseif(!empty($id)):
			//com/title.type; 
			$link = $app.'/'.$title.$type;  
		elseif(!empty($view)):
			//com/view.type; 
			$link = $app.'/'.$view.$type;
		elseif(!empty($pg)):
			//com/view.type; 
			$link = $app.'/pg/'.$pg.$type;
		else:
			//com.type; 
			$link = $app.$type; 
		endif;
	elseif($app=='page'):
		if(!empty($id)):
			//com-title.type; 
			$link = $app.'/'.$title.$type;
		else:  $link = '';
		endif;
	else:
		if(!empty($offset) && !empty($cat_id) && !empty($id) && !empty($view)):
			//com/view/cat_id/id/offset/title.type; 
			$link = $app.'/'.$view.'/'.$cat_id.'/'.$id.'/'.$offset.'/'.$title.$type; 
		elseif(!empty($offset) && !empty($id) && !empty($view)):
			//com/view/id/offset/title.type; 
			$link = $app.'/'.$view.'/'.$id.'/'.$offset.'/'.$title.$type;  
		elseif(!empty($offset) && !empty($view)):
			//com/view/offset/$title.type; 
			$link = $app.'/'.$view.'/'.$offset.'/'.$title.$type;   
		elseif(!empty($cat_id) && !empty($id) && !empty($view)):
			//com/view/cat_id/id/pg/pg.type; 
			$link = $app.'/'.$view.'/'.$cat_id.'/'.$id.'/'.$title.$type;  
		elseif(!empty($id) && !empty($view) && !empty($pg)):
			$link = $app.'/'.$view.'/'.$id.'/pg/'.$pg.$type; 
		elseif(!empty($id) && !empty($view)):
			//com/view/id/title.type; 
			if($view!='tags')
			$link = $app.'/'.$view.'/'.$id.'/'.$title.$type; 
			else
			$link = $app.'/'.$view.'/'.$engine->judul($id).$type; 
		elseif(!empty($id)):
			//com/id/title.type; 
			$link = $app.'/'.$id.'/'.$title.$type;  
		elseif(!empty($view)):
			//com/view.type; 
			$link = $app.'/'.$view.$type;  
		elseif(!empty($pg)):
			//com/view.type; 
			$link = $app.'/pg/'.$pg.$type;
		else:
			//com.type; 
			$link = $app.$type; 
		endif;
	endif;
		$htaccess = $head.'	
		RewriteRule ^([a-zA-Z0-9_-]+)/([a-zA-Z0-9_-]+)/([a-zA-Z0-9_-]+)/pg/([0-9]+)(\.html)?$ index.php?com=$1&view=$2&id=$3&pg=$4
		RewriteRule ^([a-zA-Z0-9_-]+)/([a-zA-Z0-9_-]+)/([0-9]+)/pg/([0-9]+)(\.html)?$ index.php?com=$1&view=$2&id=$3&pg=$4
		RewriteRule ^category/([a-zA-Z0-9_-]+)/pg/([0-9]+)(\.html)?$ index.php?com=post&view=category&id=$1&pg=$2
		RewriteRule ^tags/([a-zA-Z0-9_-]+)/pg/([0-9]+)(\.html)?$ index.php?com=post&view=tags&id=$1&pg=$2
		RewriteRule ^([a-zA-Z0-9_-]+)/pg/([0-9]+)(\.html)?$ index.php?com=$1&pg=$2
		
		RewriteRule ^item/([a-zA-Z0-9_-]+)(\.html)?$ index.php?com=post&view=item&id=$1
		RewriteRule ^category/([a-zA-Z0-9_-]+)(\.html)?$ index.php?com=post&view=category&id=$1
		RewriteRule ^tags/([a-zA-Z0-9_-]+)(\.html)?$ index.php?com=post&view=tags&id=$1
		RewriteRule ^page/([a-zA-Z0-9_-]+)(\.html)?$ index.php?com=page&id=$1
				
		RewriteRule ^([a-zA-Z0-9_-]+)/([a-zA-Z0-9_-]+)/([0-9]+)/([a-zA-Z0-9_-]+)(\.html)?$ index.php?com=$1&view=$2&id=$3
		RewriteRule ^([a-zA-Z0-9_-]+)/([a-zA-Z0-9_-]+)/([a-zA-Z0-9_-]+)(\.html)?$ index.php?com=$1&view=$2&id=$3
		RewriteRule ^([a-zA-Z0-9_-]+)/([0-9]+)-([a-zA-Z0-9_-]+)(\.html)?$ index.php?com=$1&id=$2
		RewriteRule ^([a-zA-Z0-9_-]+)/([a-zA-Z0-9_-]+)(\.html)?$ index.php?com=$1&view=$2
		RewriteRule ^([a-zA-Z0-9_-]+)(\.html)?$ index.php?com=$1
		'.$foot;
		create_rewrite($htaccess);
		
	elseif($engine->no()==5):
	
	if(!empty($title)) $title = $engine->judul($title);
	else $title = '';
	 
	if($app=='post'):
		if(!empty($cat_id) && !empty($id) && !empty($view)):
			//com-view-cat_id-id-title.type; 
			$link = $view.'-'.$title.$type;  
		elseif(!empty($id) && !empty($view)):
			//com-view-id-title.type; 
			if($view!='tags')
			$link = $view.'-'.$title.$type; 
			else
			$link = $view.'-'.$engine->judul($id).$type; 
		elseif(!empty($id)):
			//com-id-title.type; 
			$link = $app.'-'.$title.$type;  
		elseif(!empty($view)):
			//com-view.type; 
			$link = $app.'-'.$view.$type;
		else:
			//com.type; 
			$link = $app.$type; 
		endif;
	elseif($app=='page'):
		if(!empty($id)):
			//com-title.type; 
			$link = $app.'-'.$title.$type;
		else:  $link = '';
		endif;
	else:
		if(!empty($offset) && !empty($cat_id) && !empty($id) && !empty($view)):
			//com-view-cat_id-id-offset-title.type; 
			$link = $app.'-'.$view.'-'.$cat_id.'-'.$id.'-'.$offset.'-'.$title.$type; 
		elseif(!empty($offset) && !empty($id) && !empty($view)):
			//com-view-id-offset-title.type; 
			$link = $app.'-'.$view.'-'.$id.'-'.$offset.'-'.$title.$type;  
		elseif(!empty($offset) && !empty($view)):
			//com-view-offset-title.type; 
			$link = $app.'-'.$view.'-'.$offset.'-'.$title.$type;   
		elseif(!empty($cat_id) && !empty($id) && !empty($view)):
			//com-view-cat_id-id-title.type; 
			$link = $app.'-'.$view.'-'.$cat_id.'-'.$id.'-'.$title.$type;  
		elseif(!empty($id) && !empty($view)):
			//com-view-id-title.type; 
			if($view!='tags')
			$link = $app.'-'.$view.'-'.$id.'-'.$title.$type; 
			else
			$link = $app.'-'.$view.'-'.$engine->judul($id).$type; 
		elseif(!empty($id)):
			//com-id-title.type; 
			$link = $app.'-'.$id.'-'.$title.$type;  
		elseif(!empty($view)):
			//com-view.type; 
			$link = $app.'-'.$view.$type;  
		else:
			//com.$type; 
			$link = $app.$type; 
		endif;
	endif;
		$htaccess = $head.'	
		RewriteRule ^item-([a-zA-Z0-9_-]+)(\.html)?$ index.php?com=post&view=item&id=$1
		RewriteRule ^category-([a-zA-Z0-9_-]+)(\.html)?$ index.php?com=post&view=category&id=$1
		RewriteRule ^tags-([a-zA-Z0-9_-]+)(\.html)?$ index.php?com=post&view=tags&id=$1
		RewriteRule ^page-([a-zA-Z0-9_-]+)(\.html)?$ index.php?com=page&id=$1
				
		RewriteRule ^([a-zA-Z0-9_-]+)-([a-zA-Z0-9_-]+)-([0-9]+)-([a-zA-Z0-9_-]+)(\.html)?$ index.php?com=$1&view=$2&id=$3
		RewriteRule ^([a-zA-Z0-9_-]+)-([a-zA-Z0-9_-]+)-([a-zA-Z0-9_-]+)(\.html)?$ index.php?com=$1&view=$2&id=$3
		RewriteRule ^([a-zA-Z0-9_-]+)-([0-9]+)-([a-zA-Z0-9_-]+)(\.html)?$ index.php?com=$1&id=$2
		RewriteRule ^([a-zA-Z0-9_-]+)-([a-zA-Z0-9_-]+)(\.html)?$ index.php?com=$1&view=$2
		RewriteRule ^([a-zA-Z0-9_-]+)(\.html)?$ index.php?com=$1
		'.$foot;
		create_rewrite($htaccess);
		
	endif;	
	
	return $link;
}
