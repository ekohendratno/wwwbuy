<?php
/**
 * @file import.php
 * 
 */
 
//not direct access
defined('_iEXEC') or die();

class sidebar
{
	var $args;		
	
	function get_box($boxtitle, $boxcontent,$gets='widgets'){
		$themes_folder = Thm .get_option('template');
		$file = get_file( $themes_folder . '/' . $gets . '.php');
		$thefile = addslashes($file);
		$thefile = "\$r_file=\"".$thefile."\";";
		eval($thefile);
		return $r_file;
	}
	
	public function get($name,$position=false){
		global $iw,$db,$access;
		$total 	  	= 0;
		$num	  	= 0;	
		$position 	= esc_sql($position);				
		$applikasi 	= filter_txt($_GET['com']);
		/**********************************************
		***********************************************
						widget sidebar	
		***********************************************
		***********************************************/
		if($name=='sidebar'){
		
		if(isset($applikasi)){
			$app 	= esc_sql($applikasi);
			$qact	= $db->select('sidebar_act',array('aplikasi'=>$app));
			$numb 	= $db->num($qact);
			
			$qview	= $db->query('	SELECT * 
									FROM `'		. $iw->pre.'sidebar_act` 
									LEFT JOIN `'. $iw->pre.'sidebar` 
									ON (`'		. $iw->pre.'sidebar`.`id` = `'
												. $iw->pre.'sidebar_act`.`id_sidebar`) 
									WHERE `'	. $iw->pre.'sidebar`.`aplikasi` = "1" 
									AND `'		. $iw->pre.'sidebar_act`.`aplikasi` = "'. $app.'" 
									AND `'		. $iw->pre.'sidebar_act`.`posisi` = "'. $position.'" 
									ORDER BY `'	. $iw->pre.'sidebar_act`.`order`');
									
			$total	= $db->num($qview);
			while ($view 	= $db->fetch_assoc($qview)) {
				if($view['type']!=='app'){
					_e($this->get_box($view['title'],$view['coder']));	
				}else{		
					if(file_exists(App.  $view['file']) 
					&& $view['type']=='app'){					
						if(isset($widget)){									
							include App	. $view['file'];					
						}else{								
							ob('start');
							include App	. $view['file'];
							$out = ob('ended');
							_e($this->get_box($view['title'],@$out));
							$out ='';
						}
					}else{
						return false;
					}
				}
			}
		}		
		if (empty($total) || $total==0 && empty($numb) || $total==0) {
			
			$qview = $db->select('sidebar', array('status'=>1,'position'=>$position),'ORDER BY ordering');
					
			while ($view = $db->fetch_assoc($qview)) {	
				if($view['type']!=='app'){
					_e($this->get_box($view['title'],$view['coder']));	
				}else{		
					if(file_exists(App.  $view['file']) 
					&& $view['type']=='app'){					
						if(isset($widget)){									
							include App	. $view['file'];					
						}else{								
							ob('start');
							include App	. $view['file'];
							$out = ob('ended');
							_e($this->get_box($view['title'],@$out));
							$out ='';
						}
					}else{
						return false;
					}
				}
			}
		}
	}
	/**********************************************
	***********************************************
					menu sidebar	
	***********************************************
	***********************************************/
		if($name=='menu'){
			if ($access->cek_login() && ($access->login_level('admin') || $access->login_level('user')) ){
			if($position==0){
			$boxcontent='<ul class="sidemenu">';  
			$q=$db->select("menu_user",array('status'=>1), 'ORDER BY ordering asc');
			
			while($menuuser=$db->fetch_array($q)){
				$boxcontent.='<li>';
					if($menuuser['title']=='Logout'){
	 					$this->title='<a onclick="return confirm(\'Are You sure logout?\')" class="main-menu-act" href="'.$iw->base_url.$menuuser['url'].'"><b>'.$menuuser['title'].'</b>';
					}else{
	 					$this->title='<a class="main-menu-act" href="'.$iw->base_url.$menuuser['url'].'">'.$menuuser['title'];
					}
				$boxcontent.= $this->title.'</a></li>';
			}
			if($access->login_level('admin')){
				$boxcontent.='<li><a class="main-menu-act" href="'.$iw->base_url.'?admin">Administrator</a></li>';
			}
			$boxcontent.='</ul>';
			_e($this->get_box('Menu User',$boxcontent));
			}
			}
			
			$q = $db->select("menu",array('position'=>$position,'status'=>1));			
			while ($data = $db->fetch_array($q)) {
				
				$status 	 = 1;
				$orderby	 = $data['id'];
				$where  	 = compact('status','position','orderby');
				
				$q2 		 = $db->select('menu_sub',$where);
												
				$boxcontent	 = '<ul class="sidemenu">';
				
				while($subdata = $db->fetch_array($q2)){
					
				$boxcontent .= '<li><a class="main-menu-act" href="'.$iw->base_url.$subdata['url'].'">'.$subdata['title'].'</a></li>';
				
				}
				
				$boxcontent .='</ul>';
				_e($this->get_box($data['title'],$boxcontent));
			}
		}
	}
	
	public function position($param){
		ob('start');
		if($param == 1){
		$this->get('menu',0);
		$this->get('sidebar',0);
		}
		if($param == 2){
		$this->get('menu',1);
		$this->get('sidebar',1);
		}
		return ob('ended');
	}
}
