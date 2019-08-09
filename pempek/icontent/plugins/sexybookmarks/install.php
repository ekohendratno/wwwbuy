<?php
/**
 * @file: install.php
 * @type: plugin-sexybookmarks
 */ 
//not direct access
defined('_iEXEC') or die();

function install_sexybookmarks(){
	$install_default = array(
	'status'	=> '0',
	'bg'		=> '7', 
	'social' 	=> array(
					'comfeed',
					'delicious',
					'digg',
					'googlebuzz',
					'misterwong',
					'mixx',
					'reddit',
					'technorati',
					'twitter',
					'blogger',
					'designfloat',
					'facebook',
					'gmail'
	)
	);
	$value = jencode($install_default);
	
	if( !get_option( 'sexybookmarks' ) ) 
		 add_option( 'sexybookmarks', $value );
}
