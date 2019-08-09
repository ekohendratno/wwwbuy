<?php

/**
*	AuraCMS v.3.0
* 	Oktober 1, 2013 05:12:10 AM 
*	Iwan Susyanto, S.Si - admin@auracms.org      - 081 327 575 145
*/
 
	if (!defined('DS')) {
		define('DS', DIRECTORY_SEPARATOR);
	}

	if(DS == '/'){
		define('WEBROOT_DIR',dirname(__FILE__).'/');
	}else{
		define('WEBROOT_DIR',str_replace('\\', '/', dirname(__FILE__)).'/');
	}
	if (!defined('INC')) {
		define('INC', WEBROOT_DIR . 'includes/');
	}
	if (!defined('JS')) {
		define('JS', WEBROOT_DIR . 'js/');
	}
	if (!defined('CSS')) {
		define('CSS', WEBROOT_DIR . 'css/');
	}
	if (!defined('MOD_MEMBER')) {
		define('MOD_MEMBER', WEBROOT_DIR . 'mod-member/');
	}

	
	include INC . 'session.php';
	@header("Content-type: text/html; charset=utf-8;");
	ob_start();
	
	
	define('ADMIN', true);
	define('MEMBER', true);
	include INC . 'connection.php';
	include INC . 'mysql.php';
	include INC . 'global.php';
	include INC . 'fungsi.php';
	include INC . 'template.php';
	include INC . 'admin.lib.php';
	include INC . 'json.php';
	
	if (!defined('THEMES')) {
		define('THEMES', WEBROOT_DIR . 'themes/'.admin_themes.'/');
	}
	
	if (isset ($_GET['pg'])) $pg = int_filter ($_GET['pg']); else $pg = 0;
	if (isset ($_GET['stg'])) $stg = int_filter ($_GET['stg']); else $stg = 0;
	if (isset ($_GET['offset'])) $offset = int_filter ($_GET['offset']); else $offset = 0;
	
	$timer = new microTimer;
	$timer->start();
	
	$_GET['mod'] 	= !isset($_GET['mod']) ? null : $_GET['mod'];
	$_GET['action'] = !isset($_GET['action']) ? null : $_GET['action'];
	$_GET['view'] 	= !isset($_GET['view']) ? null : $_GET['view'];



	if (!cek_login ()){
	   	header ("location:login.php");
		exit;
	}else{
	
		if (isset($_SESSION['level']) &&  $_SESSION['level'] == 'member'){
			
			include "includes/security.php";	
					
			ob_start();
		
	
			if (!isset($_GET['mod'])) {
				include THEMES . '/normal_member.php';
			} else if (isset($_GET['mod']) && !empty($_GET['mod']) && !preg_match("/\.\./",$_GET['mod']) && file_exists(MOD_MEMBER . '/'.$_GET['mod'].'/'.$_GET['mod'].'.php')){
				include MOD_MEMBER . '/'.$_GET['mod'].'/'.$_GET['mod'].'.php';	
			} else {
				header("location:member.php");
				exit;		
			}
			
			if ($_GET['action'] == 'logout') {
				logout ();
			}
			
			$content = ob_get_contents();
			ob_end_clean();
		
		
		}else{
			header ("location:index.php");
			exit;
		}
	
	}
	
	
	if ($_GET['action'] == 'logout') {
		logout ();
	}
	
	if( empty( $_GET['mod'] ) ){		
		$menuatas  = '<li><a class="current" href="member.php">Dasbord</a></li>';
	}else{
		$menuatas  = '<li><a href="member.php">Dasbord</a></li>';
		$menuatas .= '<li><a class="current" href="member.php?mod='.cleanText($_GET['mod']).'">'.cleanText($_GET['mod']).'</a></li>';			
	}
	
	$style_include_out 	= !isset($style_include) 	? '' : implode('',$style_include);
	$script_include_out = !isset($script_include) 	? '' : implode('',$script_include);
	$define = array ('content'     		=> $content,
					 'menuatas'     	=> $menuatas,
					 'style_include' 	=> $style_include_out,
					 'script_include' 	=> $script_include_out,
	                );                
	           
	$tpl = new template ('themes/duniamaya/member.html');
	$tpl-> define_tag($define);
	$tpl-> cetak();
?>