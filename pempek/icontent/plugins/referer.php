<?php
/**
 * @file: referer.php
 * @type: plugin
 */
/*
Plugin Name: Referer
Plugin URI: http://cmsid.org/#
Description: Plugin pencatat base website sebelum di pangil.
Author: Eko Azza
Version: 1.1.0
Author URI: http://cmsid.org/
*/ 
//not direct access
defined('_iEXEC') or die();

global $iw,$db;

	function _utf8_encode( $_str ) {
		$encoding = mb_detect_encoding( $_str );
		if ( $encoding == false || strtoupper( $encoding ) == 'UTF-8' || strtoupper( $encoding ) == 'ASCII' ) {
			return $_str;
		} else {
			return iconv( $encoding, 'UTF-8', $_str );
		}
	}
	
	function determine_search_terms( $_url ) {
		if ( !is_array( $_url ) ) {
			$_url = parse_url( $_url );
		}
		
		$search_terms = '';
		
		if ( isset( $_url['host'] ) && isset( $_url['query'] ) ) {
			$sniffs = array( // host regexp, query portion containing search terms, parameterised url to decode
				array( "/images\.google\./i", 'q', 'prev' ),
				array( "/google\./i", 'q' ),
				array( "/\.bing\./i", 'q' ),
				array( "/alltheweb\./i", 'q' ),
				array( "/yahoo\./i", 'p' ),
				array( "/search\.aol\./i", 'query' ),
				array( "/search\.cs\./i", 'query' ),
				array( "/search\.netscape\./i", 'query' ),
				array( "/hotbot\./i", 'query' ),
				array( "/search\.msn\./i", 'q' ),
				array( "/altavista\./i", 'q' ),
				array( "/web\.ask\./i", 'q' ),
				array( "/search\.wanadoo\./i", 'q' ),
				array( "/www\.bbc\./i", 'q' ),
				array( "/tesco\.net/i", 'q' ),
				array( "/yandex\./i", 'text' ),
				array( "/rambler\./i", 'words' ),
				array( "/aport\./i", 'r' ),
				array( "/.*/", 'query' ),
				array( "/.*/", 'q' )
			);
			
			foreach ( $sniffs as $sniff ) {
				if ( preg_match( $sniff[0], $_url['host'] ) ) {
					parse_str( $_url['query'], $q );
					
					if ( isset( $sniff[2] ) && array_key_exists( $sniff[2], $q ) ) {
						$decoded_url = parse_url( $q[ $sniff[2] ] );
						if ( array_key_exists( 'query', $decoded_url ) ) {
							parse_str( $decoded_url['query'], $q );
						}
					}
					
					if ( isset( $q[ $sniff[1] ] ) ) {
						$search_terms = trim( stripslashes( $q[ $sniff[1] ] ) );
						break;
					}
				}
			}
		}
		
		return $search_terms;
	}
	
		function esc( $_str ) {
		if ( version_compare( phpversion(), '4.3.0', '>=' ) ) {
			return @mysql_real_escape_string( $_str );
		} else {
			return @mysql_escape_string( $_str );
		}
	}
	
	function get_domain_name($string){
	$url 		= parse_url( $string );
	$string 	= mb_substr( _utf8_encode( $string ), 0, 255 );
	
	$data   	= ( isset( $url['host'] ) ) ? mb_eregi_replace( '^www.', '', $url['host'] ) : '';
	$data   	= mb_substr( $data, 0, 255 );
	
	if ( mb_strlen( $data ) >= 25 && 
		( !isset( $_SERVER['SERVER_NAME'] ) || 
		$data != mb_eregi_replace( '^www.', '', $_SERVER['SERVER_NAME'] ) ) ) {
		return;
	}
	return $data;
}
	
$spam_words = array(
		'roulette', 'gambl', 'vegas', 'poker', 'casino', 'blackjack', 'omaha',
		'stud', 'hold', 'slot', 'bet', 'pills', 'cialis', 'viagra', 'xanax',
		'watches', 'loans', 'phentermine', 'naked', 'cam', 'sex', 'nude',
		'loan', 'mortgage', 'financ', 'rates', 'debt', 'dollar', 'cash',
		'traffic', 'babes', 'valium' );
		
$data 					= array();
$data['referrer'] 		= ( isset( $_SERVER['HTTP_REFERER'] ) ) ? $_SERVER['HTTP_REFERER'] : '';
$url 					= parse_url( $data['referrer'] );
$data['referrer'] 		= mb_substr( _utf8_encode( $data['referrer'] ), 0, 255 );

$data['domain']   		= ( isset( $url['host'] ) ) ? mb_eregi_replace( '^www.', '', $url['host'] ) : '';
$data['domain']   		= mb_substr( $data['domain'], 0, 255 );
$data['search_terms'] 	= mb_substr( _utf8_encode( determine_search_terms( $url ) ), 0, 255 );


$data['date_modif'] = date('Y-m-d H:i:s');
foreach ( $spam_words as $spam_word ) {
	if ( stristr( $data['referrer'], $spam_word ) ) {
	return;
	}
}

if ( mb_strlen( $data['domain'] ) >= 25 && 
	( !isset( $_SERVER['SERVER_NAME'] ) || 
	$data['domain'] != mb_eregi_replace( '^www.', '', $_SERVER['SERVER_NAME'] ) ) ) {
	return;
}

	$hits   = 1;
	$insert = true;
	$update = false;
	
	$query	= $db->select("stat_urls");
	while($row	= $db->fetch_array($query)){
		if($row['referrer']==$data['referrer']){
			$id		= $row['id'];
			$hits   = $row['hits'];
			$insert = false;
			$update = true;
		}
	}
	if($data['domain']!=get_domain_name($iw->base_url) && !empty($data['domain'])):
	if(!$insert){
		if($update){
		$hits = $hits+1;
		$db->update('stat_urls',array('hits' => $hits, 'date_modif' => $data['date_modif']),compact('id'));
		}
	}else{
		$db->insert('stat_urls',$data);
	}
	endif;
