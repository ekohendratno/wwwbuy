<?php
/**
 * @file version.php
 */
//dilarang mengakses
defined('_iEXEC') or die();

class update_system_ID {
	
public $version;

function perse($versi = null){
	$expl1 		= explode('.',$versi);
	$version 	= $expl1[0].'.'.$expl1[1].'.'.$expl1[2];
	
	if($expl1[3] > 0) $beta ='-beta-'.$expl1[3];
	else  $beta ='';
		
	return $version.$beta;
}

function stript( $string,$param = 'clear'){
	if(!empty( $string )){
		
		if($param == 'clear')
		return str_replace('-',' ',$string);
		
		elseif($param == 'insert')
		return str_replace(' ','-',$string);
		
		else return false;
	}
	else return '';
}

function system_cheking_updates(){
	global $iw;
	$j 	 	= new JSON_obj();
	$print 	= '';
	$set_text_check = 'Check Now';
	if(isset($_POST['submit']) && $_POST['update'] == 'yes'){
		
	
		$get_last_checked = filter_txt($_POST['last_checked_update']);
				
		$print.= $this->update_system();
		$data  = array('version' => $this->version,'date' => $get_last_checked);		
		$get_last_checked_value	  = $j->encode($data);		
		
		if( !get_option( 'last_checked_update') ) add_option( 'last_checked_update', $get_last_checked_value );
		else set_option( 'last_checked_update', $get_last_checked_value );
		
	}else{
	$get_last_checked = get_option('last_checked_update');
	$print.= '<form method="post" action="">';
		if(!empty($get_last_checked)){
			$obj   = $j->decode($get_last_checked);
			$print.= 'Last checked on '.datetimes($obj->{'date'}).'.<br><br>';
			if($obj->{'version'} > $iw->iw_version){
			$print.= '<strong>You have the latest version ID.</strong><br><br>';
			$print.= 'You have the latest version of ID. You do not need to update. However, ';
			$print.= 'if you want to re-install version '.$this->stript( $this->perse($obj->{'version'} )).', ';
			$print.= 'you can download the package and re-install manually:<br><br>';
			
			$set_text_check = 'Check Again';
			}else{
			$print.= 'Nothing new version update found<br><br>';
			}
		}
  	$print.= '<input type="hidden" name="update" value="yes">';
  	$print.= '<input type="hidden" name="last_checked_update" value="'.date('Y-m-d H:i:s').'">';
	
	$print.= '<button name="submit" class="primary"><span class="icon rss"></span>'.$set_text_check.'</button>';
	$print.= '</form>';
	}
	return $print;
}

function update_system(){
	global $iw;
	if(get_option('update_system') == 'yes'){
		
		//$url		= 'http://www.cmsid.org/';
		$url		= 'http://localhost/cmsid/2.0/0.server/';	
		$filename 	= $url."latest.v";
  		$contents 	= get_content($filename);
		
		if(!$contents):
			$content .="<div id='error'>Error: HTTP Error: couldn't connect to host</div>";
		else:
		preg_match( '|<i>(.*)<\/i>|ims', $contents, $info 			);
		preg_match( '|<versi>(.*)<\/versi>|ims', $info[1], $versi 	);
		preg_match( '|<code>(.*)<\/code>|ims', $info[1], $code 		);
		
		$this->version 	= $versi[1];
		if($versi[1] > $iw->iw_version):
		
		$version 	 	= $this->perse (	$versi[1]		);
		$version 	 	= $this->stript(	$version		);
		$now_version 	= $this->perse (	$iw->iw_version	);
		$now_version 	= $this->stript(	$now_version	);
		
			$content .= "System mendeteksi bahwa update tersedia.<br>";
			$content .= "Anda tidak perlu melakukan update, ";
			$content .= "tetapi jika anda ingin menginstall ulang versi <b>".$now_version."</b> ( ".$iw->iw_code." ) 
			ke versi <b>".$version."</b> ( ".$code[1]." ).<br>";
			$content .= "Anda dapat mendownload paket dan re-install secara manual:<br>";
			$content .= "<br><a target=\"_blank\" href=\"".$url."latest.zip?ver=".$versi[1]."\" class=\"button\">Download ".$version."</a>";
		else:
			$content .= 'Nothing new version update found';
		endif;
		
		endif;
		return $content;
		
	}
}
function display(){
	echo $this->system_cheking_updates();
}

}
