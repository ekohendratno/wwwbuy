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
				'link'  => '?admin&amp;sys=layout'
				);
		$r[] = array(
				'title' => 'Body layout',
				'link'  => '?admin&amp;sys=layout&go=layout'
				);
		$r[] = array(
				'title' => 'Styler',
				'link'  => '?admin&amp;sys=layout&go=styler'
				);
		$r[] = array(
				'title' => 'Editor',
				'link'  => '?admin&amp;sys=layout&go=editor'
				);
		return $r;
	}
}

if(!function_exists('gadget')){
	function gadget(){
		$r 	 = array();
		$r['title'] = 'Get More Theme';
		$r['desc']  = 'You can find additional themes for your site in the <a href="http://www.cmsid.org/">theme directory</a> To install a theme you generally just need to upload the theme folder into your. iw-public/tpl Directory. Once a theme is uploaded, you should see it on this page.';
		return $r;
	}
}

if(!function_exists('gadget2')){
	function gadget2($default_style_selected){
		global $iw,$db;
		$r 	 = array();
		$r['title'] = 'CSS Themes';
		
		if ( empty($default_style_selected) )
		$default_style_selected = 'content_center';
		
		$body_layout 			= array(
		1	=> array( 'Content Full'	=> 'content_full' 	),
		2	=> array( 'Content Left'	=> 'content_left'	),
		3	=> array( 'Content Right'	=> 'content_right' 	),
		4	=> array( 'Content Center'	=> 'content_center'	),
		5	=> array( 'Sidebar Left'	=> 'sidebar_left' 	),
		6	=> array( 'Sidebar Right'	=> 'sidebar_right' 	),
		);
		
		$r['desc']  .= '<ul class="menu-gadget">';
		foreach($body_layout as $key=>$val){
			foreach($val as $keys=>$vals){
			$style_selected = ($default_style_selected == $vals) ? 'style="font-weight:bold;" ' : '';
			$r['desc']  .= '<li><a href="?admin&sys=layout&go=styler&name='.$vals.'" '.$style_selected.'>'.$keys.'</a></li>';
			}
		}
		$r['desc']  .= '</ul>';
		return $r;
	}
}

function load_style_info($dir,$file=false){
	global $iw;
	if(!empty($dir)){
		$screenshot = "<p><img src='".$iw->base_url."icontent/themes/".$dir. "/screenshot.gif' width='183' height='124' align='left' style='margin-right:10px; border:1px solid #cccccc;background:#f1f1f1;' />";
	}else{
		$dir = $file;
		$screenshot = "<p><a href='?admin&sys=layout&go=preview&tpl=".$file."'><img src='".$iw->base_url."icontent/themes/".$dir. "/screenshot.gif' width='183' height='124' align='left' style='margin-right:10px; border:1px solid #cccccc;background:#f1f1f1;' /></a>";
	}
		if (file_exists(Thm.$dir.'/styleInfo.xml')) {
			$index_theme 	= @implode( '', file( Thm.$dir.'/styleInfo.xml' ) );
			$info_themes 	= str_replace ( '\r', '\n', $index_theme );
			
			preg_match( '|<themes>(.*)<\/themes>|ims'				, $info_themes, $themes 		);
			preg_match( '|<name>(.*)<\/name>|ims'					, $themes[1], $theme_name 			);
			preg_match( '|<creationDate>(.*)<\/creationDate>|ims'	, $themes[1], $theme_date 			);
			preg_match( '|<author>(.*)<\/author>|ims'				, $themes[1], $theme_author 		);
			preg_match( '|<authorEmail>(.*)<\/authorEmail>|ims'		, $themes[1], $theme_authorEmail 	);
			preg_match( '|<authorUrl>(.*)<\/authorUrl>|ims'			, $themes[1], $theme_authorUrl 	);
			preg_match( '|<copyright>(.*)<\/copyright>|ims'			, $themes[1], $theme_copyright 	);
			preg_match( '|<license>(.*)<\/license>|ims'				, $themes[1], $theme_license 		);
			preg_match( '|<description>(.*)<\/description>|ims'		, $themes[1], $theme_description 	);
			
			echo $screenshot;
			echo '<strong>'.$theme_name[1].' by <a target="_blank" href="'.$theme_authorUrl[1].'">'.$theme_author[1].'</a></strong><br />';
			echo '<i>'.$theme_description[1]."</i><br />";
			echo 'semua file themes ada di lokasi<br>
			      <span style="font: 500 1em/1.5em Lucida Console,courier new,monospace;">themes/'.$dir.'</span>';
			echo '<br><div style="clear:both"></div>';
		}else{
			echo 'Theme Corupt';
		}
}

function hiddenfile($namefile){
	$file=explode('/',$namefile);
	$file=end($file);
	return $file;
}

function __fw(){
	$file = $_POST['file'];
	$content =  stripslashes(trim ($_POST['content']));
	// Let's make sure the file exists and is writable first.
	if (is_writable($file)) {
	   if (!$handle = @fopen($file, 'w+')) {
			 $return='<div id="success">Can\'t read a file ('.hiddenfile($file).')</div>';
			exit;
	   }
	   if (fwrite($handle, $content) === FALSE) {
		    $return='<div id="error">Can\'t write a file('.hiddenfile($file).')';
		   
		   exit;
	   } 
	    $return='<div id="success">Success save to file ('.hiddenfile($file).')</div>'; 
		   //clearstatcache($handle);
		   fflush($handle);
		   fclose($handle);
	} else {
	   $return='<div id="error">File $file can\'t write</div>';
	   
	}
	return $return;
}

?>