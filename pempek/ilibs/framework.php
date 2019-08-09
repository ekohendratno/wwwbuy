<?php
/**
 * @file framework.php
 * 
 */
 
//not direct access
defined('_iEXEC') or die();
/*
 * @parameter: call(), call_tpl(), call_app_function(), call_app_file()
 *
 * start perse content 
 */
ob( 'start' );
if( !call( 'com' ) ):
/*
 * function load: call_tpl()
 * meload file frontpage pada template
 */
if(!call_tpl( 'frontpage' )) include_once( call_tpl( '404' ));
else include_once( call_tpl( 'frontpage' ));

else:
switch(call( 'com' )){
	default:
	/*
	 * @function: call_app()
	 * meload file frontpage pada template
	 */	
	if(!call_app( call( 'com' ) )):
		include_once( call_tpl( '404' ));
	else:
	/*
	 * @function: call_app_function(),call_app()
	 * tampilkan halaman apps dan @include file function apps
	 */	
		if(call_app_function( call( 'com' ) ))
		include_once( call_app_function( call( 'com' ) ));
		include_once( call_app( call( 'com' ) ));
	endif;
	break;
	case'page':
	/*
	 * @function: call_tpl()
	 * tampilkan halaman page berdasarkan @include file page template
	 */	
		if(!call_tpl( call( 'com' ) )) include_once( call_tpl( '404' ));
		else include_once( call_tpl( call( 'com' ) ) );
	break;
}
endif;

$perse[] = ob( 'ended' );
/* start perse array GLOBALS */	
$perse[] = get_( $GLOBALS['title'], 'web_title' );
$perse[] = get_( $GLOBALS['desc'], 'meta_desc' );
$perse[] = get_( $GLOBALS['key'], 'meta_key' );

/* start load file template & perse template with array()*/	
$tpl->load( 'index.php', $perse );


