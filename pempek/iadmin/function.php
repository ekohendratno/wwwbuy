<?php
/**
 * @file function.php
 *
 */
//dilarang mengakses
defined('_iEXEC') or die();

function call_templates( $call ){
	if( file_exists(Tpl.$call.'.php') 
	&& !empty( $call )
	)
	return Tpl.$call.'.php';
}

function numformat($num){
	if((int)$num) 
	return number_format ($num, 0 , ',' , '.' );
}

function uc_first($str){
    $str[0] = strtr($str,
    "abcdefghijklmnopqrstuvwxyz".
    "\x9C\x9A\xE0\xE1\xE2\xE3".
    "\xE4\xE5\xE6\xE7\xE8\xE9".
    "\xEA\xEB\xEC\xED\xEE\xEF".
    "\xF0\xF1\xF2\xF3\xF4\xF5".
    "\xF6\xF8\xF9\xFA\xFB\xFC".
    "\xFD\xFE\xFF",
    "ABCDEFGHIJKLMNOPQRSTUVWXYZ".
    "\x8C\x8A\xC0\xC1\xC2\xC3\xC4".
    "\xC5\xC6\xC7\xC8\xC9\xCA\xCB".
    "\xCC\xCD\xCE\xCF\xD0\xD1\xD2".
    "\xD3\xD4\xD5\xD6\xD8\xD9\xDA".
    "\xDB\xDC\xDD\xDE\x9F");
    return $str;
}


function encode($string,$key=3) {
  $key = sha1($key);
  $strLen = strlen($string);
  $keyLen = strlen($key);
  for ($x = 0; $x < $strLen; $x++) {
    $ordStr = ord(substr($string,$x,1));
    if ($y == $keyLen) { $y = 0; }
    $ordKey = ord(substr($key,$y,1));
    $y++;
    $hash .= strrev(base_convert(dechex($ordStr + $ordKey),16,36));
  }
  return $hash;
}

function decode($string,$key=3) {
  $key = sha1($key);
  $strLen = strlen($string);
  $keyLen = strlen($key);
  for ($x = 0; $x < $strLen; $x+=2) {
    $ordStr = hexdec(base_convert(strrev(substr($string,$x,2)),36,16));
    if ($y == $keyLen) { $y = 0; }
    $ordKey = ord(substr($key,$y,1));
    $y++;
    $hash .= chr($ordStr - $ordKey);
  }
  return $hash;
}

function count_inbx_msg(){
	global $iw,$db;
	
	$query = $db->query("
	SELECT COUNT(  'id' ) AS jumlah 
	FROM  `".$iw->pre."contact` 
	WHERE  `inbox` =  '1' AND `read` =  '0'");
	
	$data  = $db->fetch_array( $query );
	if($data['jumlah']>0) return $data['jumlah'];
	else return '0';
}

function count_inbox_msg(){
	global $iw,$db;
	
	$query = $db->query("
	SELECT COUNT(  'id' ) AS jumlah 
	FROM  `".$iw->pre."contact` 
	WHERE  `inbox` =  '1'");
	
	$data  = $db->fetch_array( $query );
	if($data['jumlah']>0) return $data['jumlah'];
	else return '0';
}

function count_outbox_msg(){
	global $iw,$db;
	
	$query = $db->query("
	SELECT COUNT(  'id' ) AS jumlah
	FROM  `".$iw->pre."contact` 
	WHERE  `outbox` =  '1'");
	
	$data  = $db->fetch_array( $query );
	if($data['jumlah']>0) return $data['jumlah'];
	else return '0';
}

function system_cheking_updates_ID(){
	$version = new update_system_ID;
	$version->display();
}


function get_content($url)
{
	if(function_exists('curl_init')) {
    $ch = curl_init();

    curl_setopt ($ch, CURLOPT_URL, $url );
    curl_setopt ($ch, CURLOPT_HEADER, 0);

    ob_start();

    curl_exec ($ch);
    curl_close ($ch);
    $string = ob_get_contents();

    ob_end_clean();
     
	}
	elseif(function_exists('file_get_contents')) {
		$string = file_get_contents($url);
	}
	else
	{
		$fh = fopen($url, 'r');
		while(!feof($fh))	{
			$string .= fread($fh, 4096);
		}
	}
		
    return $string; 
}

function list_top_menu($path,$file='manage.php'){
	if($open = @opendir($path)){
		$i = 0;
		while ($folder = readdir($open)){
			if($folder != "." && $folder != ".."){	
				if(is_dir($path.$folder)){
					if(file_exists($path.$folder.'/'.$file))	{			
					$l[$i] = htmlspecialchars($folder);
					$i++;	
					}
				}
			}
		}
		closedir($open);
	}
	return $l;
}

function widget_edit($widget){
	
	if( empty($widget) )
	return false;
	
	if( isset($_GET['widget']) && $_GET['widget'] == 'edit' && $_GET['title'] == $widget ) return true;
	else return false;
}

function widget_title($widget){
	
	if( empty($widget) )
	return false;
	
	if( widget_edit($widget) ) 
	{
		echo '<span class="configure" id="'.$widget.'">';
		echo '<a href="?admin&widget&title='.$widget.'#'.$widget.'">Cencel</a>';
		echo '</span>';
	}
	else 
	{
		echo '<span class="configure" id="'.$widget.'">';
		echo '<a href="?admin&widget=edit&title='.$widget.'#'.$widget.'">Configure</a>';
		echo '</span>';
	}
}

