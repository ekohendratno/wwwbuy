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
				'link'  => '?admin&sys=plugins'
				);
		return $r;
	}
}

if(!function_exists('gadget')){
	function gadget($id){
		global $iw,$db;
		$r 	 = array();
		$r['title'] = 'Plugin Files';
		$r['desc']  = list_files($id);
		return $r;
	}
}

function list_files($id){
	$path_dir 	= Plg.$id;
	$filed		= '<ul class="menu-gadget">';
	
	if( file_exists( $path_dir.'/'.$id.'.php' ) ){		
	foreach(rec_listFiles($path_dir) as $k) {
		if ( substr($k, -4) == '.php'){
			$l = end(explode('/',$k));
			if($l!='index.php'){
				$filed.='<li><a href="?admin&sys=plugins&go=edit&id='.$id.'&file='.str_replace(Plg,'',$k).'">'.$l.'</a></li>';
			}
		}
	}}
	
	$filed.='</ul>';
	return $filed;
}

if(!function_exists('update_plugins')){
	function update_plugins($name,$status){
		set_plugins($name,$status);
	}
}

if(!function_exists('del_plugins')){
	function del_plugins($name){
		global $db;
		
		if(!empty($name))
		$plugin_path  	= esc_sql( $name );
		
		del_folder_plugins($plugin_path);
		$db->delete('plugins',compact('plugin_path'));
	}
}

if(!function_exists('deleteDirectory')){
	function deleteDirectory($dir) { 
		if (!file_exists($dir)) return true; 
		if (!is_dir($dir) || is_link($dir)) return unlink($dir); 
			foreach (scandir($dir) as $item) { 
				if ($item == '.' || $item == '..') continue; 
				if (!deleteDirectory($dir . "/" . $item)) { 
					chmod($dir . "/" . $item, 0777); 
					if (!deleteDirectory($dir . "/" . $item)) return false; 
				}; 
			} 
		return rmdir($dir); 
	} 
}
	
if(!function_exists('del_folder_plugins')){
	function del_folder_plugins($path){
		if(empty($path))
		return false;		
		
		$path_dir = Plg.$path;
		if( file_exists( $path_dir.'/'.$path.'.php' ) ){
			deleteDirectory($path_dir);
		}
		else  unlink($path_dir.'.php');
	}
}

function rec_listFiles( $from = '.')
{
    if(! is_dir($from))
        return false;
    
    $files = array();
    if( $dh = opendir($from))
    {
        while( false !== ($file = readdir($dh)))
        {
            // Skip '.' and '..'
            if( $file == '.' || $file == '..')
                continue;
            $path = $from . '/' . $file;
            if( is_dir($path) )
                $files += rec_listFiles($path);
            else
                $files[] = $path;
        }
        closedir($dh);
    }
    return $files;
}

if(!function_exists('get_file_name')){
	function get_file_name($string){
		return end( explode('/',$string) );
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
				$return='<div id="error">Can\'t write a file('.get_file_name($file).')';
			   
			   exit;
		   } 
			   //clearstatcache($handle);
			fflush($handle);
			fclose($handle);
			echo '<div id="success">Success save to file ('.get_file_name($file).')</div>'; 
		} else {
		    echo '<div class="error">File $file can\'t write</div>';		   
		}
	}
}