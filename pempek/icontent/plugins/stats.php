<?php
/**
 * @file: stats.php
 * @type: plugin
 */
/*
Plugin Name: Stats
Plugin URI: http://cmsid.org/#
Description: Plugin pencatat pengunjung atau client website.
Author: Eko Azza
Version: 1.1.0
Author URI: http://cmsid.org/
*/ 
//not direct access
defined('_iEXEC') or die();

class stats
{	
	function start($stat){
		global $db;
		//count
		$q				= $db->select('stat_count',array('id'=>1));
		while ( $data 	= $db->fetch_array($q) ) {
		$visitor		= $data[2];
		$hits			= $data[3];
		}		
		if($stat	   == 'now'){
		$q				= $db->select("stat_online");
		return $db->num($q);
		}elseif($stat  == 'day'){
		$q				= $db->select("stat_onlineday");
		return $db->num($q);
		}elseif($stat  == 'month'){
		$q				= $db->select("stat_onlinemonth");
		return $db->num($q);
		}elseif($stat  == 'hits'){
		return $hits;
		}elseif($stat  == 'visitor'){
		return $visitor;
		}else{
		return 0;
		}
	}
	function updateon($time){
		global $iw,$db;
		
		if (preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/', getenv("HTTP_X_FORWARDED_FOR")) == ''){
		$uipanda = getenv('REMOTE_ADDR');
		}else{
		$uipanda = getenv('HTTP_X_FORWARDED_FOR');
		}
		$uproxyserver	= getenv("HTTP_VIA");
		$uipproxy		= getenv("REMOTE_ADDR");
		$uhost			= gethostbyaddr($uipproxy);
		$utime			= time();
		if($time=='now'){			
			$now	= $utime-600;
			
					  $db->query("delete from ".$iw->pre."stat_online where timevisit<$now");
			$q		= $db->select('stat_online',array('ipproxy'=>$uipproxy));
			$uexists= $db->num($q);
			
			if ($uexists>0){
				$db->update('stat_online', array('timevisit'=>$utime), array('ipproxy'=>$uipproxy) );
			} else {
				$ipproxy 		= esc_sql($uipproxy);
				$host 			= esc_sql($uhost);
				$ipanda 		= esc_sql($uipanda);
				$proxyserver 	= esc_sql($uproxyserver);
				$timevisit 		= esc_sql($utime);
				
				$data = compact('ipproxy','host','ipanda','proxyserver','timevisit');
				$db->insert('stat_online', $data);
			}
		}elseif($time=='day'){
			$day	= $utime-86400;	
			
					  $db->query("delete from ".$iw->pre."stat_onlineday where timevisit<$day");
			$q		= $db->select('stat_onlineday',array('ipproxy'=>$uipproxy));
			$uexists= $db->num($q);	
			
			if ($uexists>0){ 
				$db->update('stat_onlineday', array('timevisit'=>$utime), array('ipproxy'=>$uipproxy) );
			} else {
				$ipproxy 		= esc_sql($uipproxy);
				$host 			= esc_sql($uhost);
				$ipanda 		= esc_sql($uipanda);
				$proxyserver 	= esc_sql($uproxyserver);
				$timevisit 		= esc_sql($utime);
				
				$data = compact('ipproxy','host','ipanda','proxyserver','timevisit');
				$db->insert('stat_onlineday', $data);
			}
		}elseif($time=='month'){
			$month	= $utime-2592000; // (in seconds)
			
					  $db->query("delete from ".$iw->pre."stat_onlinemonth where timevisit<$month");
			$q		= $db->query("select id from ".$iw->pre."stat_onlinemonth where ipproxy='$uipproxy'");
			$uexists= $db->num($q);	
			
			if ($uexists>0){
				$db->update('stat_onlinemonth', array('timevisit'=>$utime), array('ipproxy'=>$uipproxy) );
			} else {
				$ipproxy 		= esc_sql($uipproxy);
				$host 			= esc_sql($uhost);
				$ipanda 		= esc_sql($uipanda);
				$proxyserver 	= esc_sql($uproxyserver);
				$timevisit 		= esc_sql($utime);
				
				$data = compact('ipproxy','host','ipanda','proxyserver','timevisit');
				$db->insert('stat_onlinemonth', $data);
			}
		}else{
		}
	}
	function update(){
		global $iw,$db;
		
		$IPnum 			= "0.0.0.0";
		$userStatus 	= 0;
		$maxadmindata 	= 20;
		$IPnum 			= getenv("REMOTE_ADDR");
		$q 				= $db->select('stat_count',array('id'=>1));
		$total 			= $db->num($q);
		if ($total     <= 0){
			$id 		= 1;
			$ip 		= esc_sql($IPnum);
			$counter 	= 1;
			$hits 		= 1;
			
			$data = compact('id','ip','counter','hits');
			$db->insert('stat_count', $data);
		}
		while ( $data 	= $db->fetch_array($q) ) {
		$IPdata			= $data[1];
		$theCount		= $data[2];
		$hits			= $data[3];
		}
		$IParray 		= explode("-",$IPdata);
		$ipCountMax		= count($IParray);
		for($ipCount=0;$ipCount<$ipCountMax;$ipCount++){	
			if($IParray[$ipCount]==$IPnum){
				$userStatus = 1;       
			}
		}
		$IPdata			= '';	
		
		if($userStatus == 0){
		$IPdata			="$IPnum-";
		for ($i=0; $i<$maxadmindata; $i++){
		$IPdata 	   .= "$IParray[$i]-";		
		}
		$theCount++;		
			$ip 		= esc_sql($IPdata);			
			$counter	= esc_sql($theCount);			
			
			$data = compact('id','counter');
			$db->update('stat_count', $data,array('id'=>1));
		}				
		$hits++;		
			$hits	= esc_sql($hits);			
			$db->update('stat_count', compact('hits'),array('id'=>1));
			
			$this->updateon('now');
			$this->updateon('day');
			$this->updateon('month');
	}
}

if(class_exists('stats')) $stats = new stats;
if(!isset($_GET['admin'])) {
	$stats->update();
}
function statistik($switch){
	$stats = new stats;
	switch($switch){
		case'now':
		return $stats->start('now');
		break;
		case'day':
		return $stats->start('day');
		break;
		case'month':
		return $stats->start('month');
		break;
		case'hits':
		return $stats->start('hits');
		break;
		case'visitor':
		return $stats->start('visitor');
		break;
	}
}