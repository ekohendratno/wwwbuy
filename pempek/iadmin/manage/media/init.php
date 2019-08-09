<?php
/**
 * @file init.php
 *
 */
//dilarang mengakses
defined('_iEXEC') or die();

if(!function_exists('menu')){
	function menu(){
		$r   = array();
		$r[] = array(
				'title' => 'Home',
				'link'  => '?admin&sys=media'
				);
		return $r;
	}
}

if(!function_exists('gadget1')){
	function gadget1(){
		$r 	 = array();
		$r['title'] = 'Catatan';
		$r['desc']  = 'Untuk delete folder, isi folder harus di kosongkan terdahulu<br>CHMOD hanya untuk UNIX/Linux.';
		return $r;
	}
}

if(!function_exists('gadget2')){
	function gadget2($max_space, $dir_levels){
		$r 	 = array();		
		$r['title'] = 'Disk Usage';
		$r['desc']  =  quota($max_space, $dir_levels);
		return $r;
	}
}

if(!function_exists('gadget3')){
	function gadget3(){
		$r 	 = array();		
		$r['title'] = 'Version';
		$r['desc']  = '
		<p><span class="dr">2 beta</span>maaf karena versinya masih beta, perlu penyempurnaan untuk media mengernya.</p>';
		return $r;
	}
}

if(!function_exists('get_file_name')){
	function get_file_name($string){
		return end( explode('/',$string) );
	}
}

function chmodr($path, $filemode) { 
    if (!is_dir($path)) 
        return chmod($path, $filemode); 

    $dh = opendir($path); 
    while (($file = readdir($dh)) !== false) { 
        if($file != '.' && $file != '..') { 
            $fullpath = $path.'/'.$file; 
            if(is_link($fullpath)) 
                return FALSE; 
            elseif(!is_dir($fullpath) && !chmod($fullpath, $filemode)) 
                    return FALSE; 
            elseif(!chmodr($fullpath, $filemode)) 
                return FALSE; 
        } 
    } 

    closedir($dh); 

    if(chmod($path, $filemode)) 
        return TRUE; 
    else 
        return FALSE; 
}

function show_perms( $in_Perms ) {
   // owner
   $sP .= (($in_Perms & 0x0100) ? 'r' : '&minus;') . (($in_Perms & 0x0080) ? 'w' : '&minus;') . (($in_Perms & 0x0040) ? (($in_Perms & 0x0800) ? 's' : 'x' ) : (($in_Perms & 0x0800) ? 'S' : '&minus;'));
   // group
   $sP .= (($in_Perms & 0x0020) ? 'r' : '&minus;') . (($in_Perms & 0x0010) ? 'w' : '&minus;') . (($in_Perms & 0x0008) ? (($in_Perms & 0x0400) ? 's' : 'x' ) : (($in_Perms & 0x0400) ? 'S' : '&minus;'));
   // world
   $sP .= (($in_Perms & 0x0004) ? 'r' : '&minus;') . (($in_Perms & 0x0002) ? 'w' : '&minus;') . (($in_Perms & 0x0001) ? (($in_Perms & 0x0200) ? 't' : 'x' ) : (($in_Perms & 0x0200) ? 'T' : '&minus;'));
   return $sP;
 }
 
function quota($max_space, $dir_levels){
	$ignore_files = array('..', '.'); 
	$start_dir = getcwd();
	$sized = sum_dir($start_dir, $ignore_files, $dir_levels);
	$remaining = $max_space - $sized;
	$usage = round($sized/1024, 3);
	$free  = round($remaining/1024, 3);
	return 'Usage: '.$usage.' MB <br> Free: '.$free.' MB';
}

function file_end($fail)
{
	$a = explode(".", $fail);
	$b = count($a);
	return $a[$b-1];
}

function mine_kataloog($dir)
{
	$tykid = explode("/", $dir);
	$arv = count($tykid);
	$tykid2 = array();
	for($i = 0; $i < $arv - 1; $i++)
	{
		$tykid2[$i] = $tykid[$i];
	}
	$dir2 = implode("/", $tykid2);
	return $dir2;
}

function file_size($size) 
{
	$sized = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB');
	$yh = $sized[0];
	for ($i=1; (($i < count($sized)) && ($size >= 1024)); $i++) 
	{
		$size = $size / 1024;
		$yh   = $sized[$i];
	}
	return round($size, 2)." ".$yh;
}

function file_date($aeg)
{
	return date ("d.m.y H:i:s", $aeg);
}

function file_icon($l)
{
	global $icon_id;
	$l = strtolower($l);
	if(in_array($l, $icon_id))
	{
		return "iadmin/manage/media/images/icon/".$l.".gif";
	}
	else
		return "iadmin/manage/media/images/icon/tundmatu.gif";
}

function sum_dir($start_dir, $ignore_files, $levels = 1) 
{
	if ($dir = opendir($start_dir)) 
	{
		while ((($file = readdir($dir)) !== false)) 
		{
			if (!in_array($file, $ignore_files)) 
			{
				if ((is_dir($start_dir . '/' . $file)) && ($levels - 1 >= 0)) 
				{
					$levels -= 1;
					$filesize += sum_dir($start_dir . '/' . $file, $ignore_files, $levels);
				} 
				elseif (is_file($start_dir . '/' . $file)) 
				{					
					$filesize += filesize($start_dir . '/' . $file) / 1024;
				}
			}
		}
		
		closedir($dir);
		return $filesize;
	}
}

if(!function_exists('make_dir_file')){
	function make_dir_file($data,$file='index.php'){
		extract($data, EXTR_SKIP);
		
		if(is_dir($path."/".$name_folder)){
			echo'<div id="error">Folder "'.$name_folder.'" sudah ada!</div>';
		}else{
		if(@mkdir($path."/".$name_folder, 0775)){
			if( !empty( $html_template ) || $html_template == 1){
				$file = $path."/".$name_folder."/".$file;
				if ( !file_exists($file) ){
					touch ($file);
					$handle = fopen ($file, 'r+');
					$content= '<?php
// Silence is golden.
?>';
				}else{
					$handle = fopen ($file, 'r+');
					$content= '<?php
// Silence is golden.
?>';
				}
				rewind ($handle);
				fwrite ($handle, ++$content);
				fclose ($handle);
			}
			echo'<div id="success">Add sukses!</div>';
			echo'<meta http-equiv="refresh" content="1; url=?admin&sys=media&path='.encode($path).'" />'; 
		}else{
			echo'<div id="error">Add gagal Nama Folder harus diisini!</div>';
		}	
		}
	}
}

if(!function_exists('del_folder_file')){
	function del_folder_file($path){
		foreach (glob($path) as $file) {
			if (is_dir($file)) { 
				del_folder_file("$file/*");
				rmdir($file);
			}else{
				unlink($file);
			}
   		}
		$dirx = explode("/",$path);
		$diry = "";
		for($i=0;$i<(count($dirx)-1);$i++){
			$diry = $diry.$dirx[$i]."/";
		}
		$diry = substr($diry,0,-1);
		redirect("?admin&sys=media&path=".encode($diry));		
	}
}

if(!function_exists('set_permission')){
	function set_permission($path,$level){
		if (chmodr($path, octdec('0'.$new))){
			_e('<div id="success">Chmod is setted 0'.$level.' on '.$path.'.</div>');			
			_e('<meta http-equiv="refresh" content="1; url=?admin&sys=media&path='.encode($path).'" />');
		}
		else _e('<div id="error">Cant set chmod '.$level.' on '.$path.'.</div>');
	}
}

if(!function_exists('set_rename')){
	function set_rename($old,$new){	
		if (@rename($old,$new)){
			_e('<div id="success">Rename is setted '.$old.' on '.$new.'.</div>');			
			echo'<meta http-equiv="refresh" content="1; url=?admin&sys=media&path='.encode($new).'" />';
		}
		else _e('<div id="error">Cant set Rename '.$old.' on '.$new.'.</div>');
	}
}

if(!function_exists('perms')){
	function perms($file)
	{
		return substr(sprintf('%o', $file), -3);
	}
}

if(!function_exists('save_to_file')){
	function save_to_file($file){
		$content =  stripslashes(trim ($_POST['content']));
		// Let's make sure the file exists and is writable first.
		if (is_writable($file)) {
		   if (!$handle = @fopen($file, 'w+')) {
				echo'<div class="info">Can\'t read a file ('.get_file_name($file).')</div>';
				exit;
		   }
		   if (fwrite($handle, $content) === FALSE) {
				echo'<div id="error">Can\'t write a file('.get_file_name($file).')';
			   
			   exit;
		   } 
			   //clearstatcache($handle);
			   fflush($handle);
			   fclose($handle);
			echo'<div id="success">Success save to file ('.get_file_name($file).')</div>'; 
		} else {
		   echo'<div class="error">File $file can\'t write</div>';		   
		}
	}
}

?>