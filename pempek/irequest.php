<?php
/**
 * @file irequest.php
 *
 */
 
//not direct access
if (!defined("_iEXEC")):
define('_iEXEC', true);

/*
 * start compressing 
 */
if ( ini_get( 'zlib.output_compression' ) || 'ob_gzhandler' == ini_get( 'output_handler' ) ) {
	if (function_exists( 'ob_gzhandler' ) )
	{
		ob_start( 'ob_gzhandler' );
	}
}
//no access if $iw_load_isset not isset
if( !isset( $iLoad ) ){
	$iLoad = true;
	
	//load configuration
	require_once( dirname(__FILE__) . '/iconfig.php' ); 

	//load global var $iw
	iw('config');
	
	//impot file system
	require_once( Inc . 'import.php' );	
	
	if(isset($_GET['auto'])){
		set_widgets($_GET["sort"]);
	}else{	
		require_once( Inc . 'framework-request.php' );	
	}
		
}

ob_end_flush();

endif;

?>
