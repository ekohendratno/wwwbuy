<?php
/**
 * @file int.php
 *
 */
//dilarang mengakses
defined('_iEXEC') or die();

include 'function.php';
class init
{
	function get_file(){
		global $iw,$access;
		
		$apps = filter_txt($_GET['apps']);
		$sys  = filter_txt($_GET['sys']);
		$plg  = filter_txt($_GET['plugins']);
		
		//if(!empty($apps) && !empty($sys))
		if(isset($_GET['login']) && empty($_GET['login'])){
			ob_start();
			include Tpl.'ilogin.php';
			$CONTENT=ob_get_contents();
			ob_end_clean();
			include Tpl.'login.php';
		}
		if(isset($_GET['admin']) && empty($_GET['admin'])){			
		if($access->cek_login() && $access->login_level('admin')){
			ob_start();
			if(isset($apps) && !empty($apps)){
				if(!file_exists( App.$apps.'/manage.php')){
					include_once( call_templates( '404' ));
				}else{
					include App.$apps.'/manage.php';
				}
			}elseif(isset($sys) && !empty($sys)){
				if($sys=='logout'){
					//log out
				}else{
					if(!file_exists( Mng.$sys.'/manage.php')){
						include_once( call_templates( '404' ));
					}else{
						include Mng.$sys.'/manage.php';
					}
				}
			}elseif(isset($plg) && !empty($plg)){
				if(!file_exists( Plg.'manage.'.$plg.'.php')){
					include_once( call_templates( '404' ));
				}else{
						include Plg.'manage.'.$plg.'.php';
				}
			}else{
			include Tpl.'ihome.php';
			}
			$content = ob_get_contents();
			ob_end_clean();
			
			require_once(Tpl.'admin.php');
		}else{
			redirect();
		}
		}
	}
}

	$init= new init();
_e( $init->get_file() );
?>