<?php
/**
 * @file: browse.php
 * @type: plugin
 */
/*
Plugin Name: Stats Browse
Plugin URI: http://cmsid.org/#
Description: Plugin pencatat pengunjung atau client website.
Author: Eko Azza
Version: 1.1.0
Author URI: http://cmsid.org/
*/ 
//not direct access
defined('_iEXEC') or die();

global $iw,$db,$session;

function get_browser_id($user_agent)
{
	$browsers = array(
		0 	=> 'Opera', //Opera
		1	=> '(Firebird)|(Firefox)', //Mozilla Firefox
		2 	=> 'Galeon', //Galeon
		3	=> 'Gecko', //Mozilla, Crome
		4	=> 'MyIE', //MyIE
		5	=> 'Lynx', //Lynx
		6	=> '(Mozilla/4\.75)|(Netscape6)|(Mozilla/4\.08)|(Mozilla/4\.5)|(Mozilla/4\.6)|(Mozilla/4\.79)', //Netscape
		7	=> 'Konqueror', //Konqueror
		8 	=> '(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp/cat)|(msnbot)|(ia_archiver)', //SearchBot
		9 	=> '(MSIE 6\.[0-9]+)', //IE 6
		10 	=> '(MSIE 7\.[0-9]+)', //IE 7
		11 	=> '(MSIE 8\.[0-9]+)', //IE 8
		12 	=> '(MSIE 9\.[0-9]+)', //IE 9
		13 	=> '(MSIE 10\.[0-9]+)', //IE 10
	);

	foreach($browsers as $browser=>$pattern)
	{
		if (eregi($pattern, $user_agent))
			return $browser;
	}
	return 14;
}

function get_os_id($user_agent)
{
	$oss = array(
		0 	=> 'Win', //Windows Microsoft
		1	=> '(Mac)|(PPC)', //Apple Macintosh
		2 	=> 'Linux', //Linux
		3	=> 'FreeBSD', //FreeBSD
		4	=> 'SunOS', //SunOS
		5	=> 'IRIX', //IRIX
		6	=> 'BeOS', //BeOS
		7	=> 'OS/2', //OS/2
		8 	=> 'AIX', //AIX	
	);

	foreach($oss as $os=>$pattern)
	{
		if (eregi($pattern, $user_agent))
			return $os;
	}
	return 9;
}

function get_stat_browse($param){
	global $iw,$db;
	$title	= esc_sql($param);
	$qry 	= $db->select('stat_browse',compact('title'));
	$data 	= $db->fetch_array($qry);
	return $data;
	
}

function set_stat_browse($param,$hits){
	global $iw,$db;
	$title	= esc_sql($param);
	$hits	= esc_sql($hits);
	$db->update('stat_browse',compact('hits'),compact('title'));	
}

function update_stat_browse($param,$value){
	$data		= get_stat_browse($param);
	$tmp	 	= explode("#", $data["hits"]);
	$tot 		= count($tmp);
	$hits 		= '';
	$tmp[$value]++;
	for($i=0;$i<$tot;$i++) $hits.= $tmp[$i] . "#";	
	$hits 		= substr_replace($hits, "", -1, 1);
	set_stat_browse($param,$hits);
}

$time 		= 0;
$jam 		= date('G', time() + $time);
$bulan 		= date('m', time() + $time);
$hari		= date('w', time() + $time);
$tanggal 	= date('d', time() + $time);

$get_agent	= getenv("HTTP_USER_AGENT");
$os 		= get_os_id($get_agent);
$browser 	= get_browser_id($get_agent);

if( !$session->get('visitor_browse') ):

update_stat_browse('browser',	$browser);
update_stat_browse('os',		$os);	
update_stat_browse('day',		$hari);
update_stat_browse('month',		$bulan - 1);
update_stat_browse('clock',		$jam);

$session->set('visitor_browse',true);   
endif;