<?php
/**
 * @file template.php
 * 
 */
 
//not direct access
defined('_iEXEC') or die();

class tpl extends sidebar 
{
	var $tpl		= '';
	
	var $args		= array();
	
	public $i = array();
	
	function __construct( $perse = array() ){
		global $iw;
		if(!empty($perse[1])) $title 	= $perse[1];
		else $title = '';
		if(!empty($perse[2])) $desc 	= $perse[2];
		else $desc = '';
		if(!empty($perse[3])) $key 		= $perse[3];
		else $key = '';
		if(!empty($perse[0])) $content 	= $perse[0];
		else $content = '';
		
		$this->i = array(
		'meta' 		=> 	array(
					'title' 		=> $title,
					'desc' 			=> $desc,
					'key' 			=> $key
		),
		'main' 		=> 	array( 
					'content' 		=> $content,
					'sidebar-1' 	=> $this->position(1),
					'sidebar-2' 	=> $this->position(2),
					'title' 		=> get_option( 'web_title' ),
					'slogan' 		=> get_option( 'web_slogan' ),
					'exe' 			=> timer_stop(),
					'versi' 		=> $iw->iw_version,
		),
		'base'		=>	array(
					'base'			=> $iw->base_url,
					'dir_themes' 	=> $iw->base_url 
					. 'icontent/',
					'themes' 		=> $iw->base_url 
					. 'icontent/themes/' 
					. get_option('template')
					. '/'
		),
		);
	}
	function meta( $param ){
		return _each( $this->i['meta'], $param );			
	}
	function main( $param ){
		return _each( $this->i['main'], $param );
	}
	function url( $param ){
		return _each( $this->i['base'], $param );
	}
	function active( $param ){
		return layout( $param );
	}
	function refile( $file ){
		global $tpl;	
		
		if ( file_exists( $this->fl( $file ) ) && !empty( $file ) )
		{
			if (!preg_match( '/\.\./', $file ) && !isset( $file ) ? null : $file )
			return require_once( $this->fl( $file ) );
			
			else print_error('Error Template','Template Not Found');
		}
		else print_error('Error Template','Template Not Found');
	}

	function load( $file, $perse = array() ){
		$this->__construct( $perse );
		return $this->ended( $file );
	}
	
	function fl( $file ){
		return $this->base() . $file;
	}	
	
	function base($params=false){
		if( $params =='url' ) $base = $this->url( 'dir_themes' );
		else $base = Thm;
		
		return $base . get_option('template'). '/';
	}
	
	function ended( $file ){
				ob( 'start' );
				$this->refile( $file );
		$get = 	_e(ob( 'ended' ));
		return  $get;
	}
	
}

function template(){
	global $tpl;
	$tpl = new tpl;
}
