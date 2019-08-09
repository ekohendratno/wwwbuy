<?php
/**
 * @file: geoip.php
 * @type: plugin
 */
/*
Plugin Name: Geo IP
Plugin URI: http://cmsid.org/#
Description: Plugin Text Editor.
Author: Eko Azza
Version: 1.1.0
Author URI: http://cmsid.org/
*/ 
//not direct access
defined('_iEXEC') or die();

function anonymise_ip( $_addr, $_mask ) {
		$addr = long2ip( ip2long( $_addr ) & ip2long( $_mask ) );
		if ( $addr == '0.0.0.0' ) {
			$addr = '';
		}
		return $addr;
	}
	
function _determine_remote_ip($anonymise_ip_mask) {
		
		$remote_addr = $_SERVER['REMOTE_ADDR'];
		if ( ( $remote_addr == '127.0.0.1' || $remote_addr == '::1' || $remote_addr == $_SERVER['SERVER_ADDR'] ) &&
		     array_key_exists( 'HTTP_X_FORWARDED_FOR', $_SERVER ) && $_SERVER['HTTP_X_FORWARDED_FOR'] != '' ) {
			// There may be multiple comma-separated IPs for the X-Forwarded-For header
			// if the traffic is passing through more than one explicit proxy. Take the
			// last one as being valid. This is arbitrary, but there is no way to know
			// which IP relates to the client computer. We pick the first client IP as
			// this is the client closest to our upstream proxy.
			$remote_addrs = explode( ', ', $_SERVER['HTTP_X_FORWARDED_FOR'] );
			$remote_addr = $remote_addrs[0];
		}
		
		if ( $anonymise_ip_mask != '' && $anonymise_ip_mask != '255.255.255.255' ) {
			$remote_addr = anonymise_ip( $remote_addr, $anonymise_ip_mask );
		}
		
		return $remote_addr;
	}
	
function is_geoip_installed() {
		return ( file_exists( Plg.'geoip/geoip.class.php' ) &&
		         file_exists( Plg.'geoip/GeoIP.dat' ) );
	}
	
function _determine_country( $_ip ) {
		if ( is_geoip_installed() ) {
			include_once( Plg.'geoip/geoip.class.php' );
			$gi = geoip_open( Plg.'geoip/GeoIP.dat', GEOIP_STANDARD );
			return geoip_country_code_by_addr( $gi, $_ip );
			geoip_close( $gi );
		} else {
			return '';
		}
	}

function _get_stat_browse($param){
	global $iw,$db;
	$title	= esc_sql($param);
	$qry 	= $db->select('stat_browse',compact('title'));
	$data 	= $db->fetch_array($qry);
	return $data;
	
}
function _set_stat_browse($title,$data){
	global $db;
	$db->update('stat_browse',$data,compact('title'));	
}

function get_country_stat($country){
	$data 		= _get_stat_browse('country');
	if($data['option'] == '' || $data['hits'] == ''){
		
	$datas = array('option'=>$country.'#','hits'=>'1#');
	_set_stat_browse('country',$datas);
		
	}else{
		$get_opt	= explode("#", $data["option"]);	
		$get_hit 	= explode("#", $data["hits"]);	
		$hit 		= $opt = array();
		$hits 		= $option = '';
		$upd  		= true;
		foreach($get_opt as $key => $val){
			if($country == $val) 
			{
				$optx = $get_opt[$key];
				$hitx = $get_hit[$key]+1;
				$upd  = false;
			}
			else 
			{
				$optx = $get_opt[$key];
				$hitx = $get_hit[$key];
			}
			
			$opt[] = $optx;
			$hit[] = $hitx;
		}
		
		if($upd)
		{
			$opt[] = $country;
			$hit[] = 1;
		}
		
		foreach($opt as $k=>$v)
		{
			if(!empty($v) && !empty($hit[$k])){
				$option	.= $v.'#';
				$hits	.= $hit[$k].'#';
			}
		}
		if(!empty($option) && !empty($hits))
		_set_stat_browse('country',array('option'=>$option,'hits'=>$hits));
	}
	
}

$anonymise_ip_mask 	= '255.255.255.0';
$remote_ip 			= mb_substr( _determine_remote_ip( $anonymise_ip_mask ), 0, 15 );
$country   			= _determine_country( $remote_ip );

get_country_stat($country);

