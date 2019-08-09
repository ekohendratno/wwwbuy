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
				'link'  => '?admin&amp;sys=backup'
				);
		return $r;
	}
}

if(!function_exists('gadget')){
	function gadget(){
		$r 	 = array();
		$r['title'] = 'More Info';
		$r['desc']  = '
		<p><span class="dr">Path Backup</span>direktori atau folder yang di backup.</p>
		<p><span class="dr">Path Skip</span>path direktori yang tidak disertakan dalam backup, opsi ini menggunakan array jadi anda bisa menyertakan beberapa path skip</p>
		<p><span class="dr">Path Store</span>tempat penyimpan file backup</p>
		<p><span class="dr">Name File</span>nama file backup, jika anda memilih opsi encrypt nama file maka secara otomatis nama file akan diencripsi dengan md5</p>
		<p><span class="dr">Time Out</span>sesi waktu atau lama waktu maupun batas waktu untuk mendownload file backup per detik, jika timout maka file akan dihapus dari server secara otomatis</p>
		';
		return $r;
	}
}

if(!function_exists('file_size')){
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
}

if(!function_exists('validPath')){
	function validPath($string) //don't use for URL type
	{
		$strToFilter = strip_tags(trim($string));
		$strToFilter = str_replace("//", "/", $strToFilter);
		$strToFilter = str_replace("\\", "/", $strToFilter);
	
		return $strToFilter;
	}
}

if(!function_exists('getlast')){
	function getlast($toget)
    {
	    $pos	 = strrpos($toget,".");
	    $lastext = strtolower(substr($toget,$pos+1));
		return $lastext;
    }
}

if(!function_exists('getRealFileName')){
	function getRealFileName($strFile) //full file path
	{
		$validStrPath   =  validPath($strFile);
		$validStrPath  	=  str_replace(dirname($validStrPath).'/', '', $validStrPath);
		$validStrPath	=  str_replace('.'.getlast($validStrPath), '', $validStrPath);

		return $validStrPath;
	}
}

if(!function_exists('clearString')){
	function clearString($value)
	{
		if(get_magic_quotes_gpc())
		{
        	$value = stripslashes($value);
    	}
    	if(!is_numeric($value))
    	{
        	$value = mysql_real_escape_string($value);
    	}
    	return $value;
	}
}

if(!function_exists('remove')){
	function remove($item) 
	{
		$item = realpath($item);
		$ok = true;
		if( is_link($item) ||  is_file($item))
	  		$ok =  @unlink($item);
		return $ok;
	}
}

if(!function_exists('showtableDB')){
	function showtableDB(){
		$tables = array();
		$query=mysql_query('SHOW TABLES');
		while($row = mysql_fetch_array($query))
		{
			$tables[] = $row[0];
		}
		return $tables;
	}
}

if(!function_exists('dumpDB')){
	function dumpDB($tables)
	{
		
		if($tables == '*')
		{
			$tables 	= array();
			$query		= mysql_query('SHOW TABLES');
			while($row	= mysql_fetch_array($query))
			{
				$tables[] = $row[0];
			}
		}
		else
		{
			$tables = is_array($tables) ? $tables : explode(',',$tables);
		}
	
		foreach($tables as $table)
		{
			$query= mysql_query('SELECT * FROM '.$table);
			$num_fields = mysql_num_fields($query);
			$return.= 'DROP TABLE IF EXISTS '.$table.';';
			$query2= mysql_query('SHOW CREATE TABLE '.$table);
			$row2 = mysql_fetch_array($query2);
			$return.= "\n\n".$row2[1].";\n\n";
			for ($i = 0; $i < $num_fields; $i++) 
			{
				while($row = mysql_fetch_array($query))
				{
					$return.= 'INSERT INTO '.$table.' VALUES(';
					for($j=0; $j<$num_fields; $j++) 
					{
						$str = addslashes($row[$j]);
						$str = str_replace("'", "'", $str);
						$str = str_replace("\n", '', $str);
						$str = str_replace("\r", '', $str);
						$str = str_replace('"', '"', $str);
						$str = str_replace("'", "'", $str);
						$str = str_replace("`", "'", $str);
						$str = str_replace('"', '"', $str);
						$str = str_replace('\"', '"', $str);
						if (isset($str)) { $return.= "'".$str."'"; } else { $return.= "''"; }
						if ($j<($num_fields-1)) { $return.= ', '; }
					}
					$return.= ");\n";
				}
			}
			$return.="\n\n\n";
		}
		return $return;
	}
}


if(!function_exists('directoryToArray')){
	function directoryToArray($directory, $recursive) {
		$array_items = array();
		if ($handle = opendir($directory)) {
			while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != "..") {
			if (is_dir($directory. "/" . $file)) {
			if($recursive) {
				$array_items = array_merge($array_items, directoryToArray($directory. "/" . $file, $recursive));
			}
			$file = $directory . "/" . $file ."/";
			$array_items[] = preg_replace("/\/\//si", "/", $file);
			}else{
			$file = $directory . "/" . $file;
			$array_items[] = preg_replace("/\/\//si", "/", $file);
			}}}
			closedir($handle);
		}
		return $array_items;
	}
}

if(!function_exists('save_to_file')){
	function save_to_file($data){
		global $iw;
		extract($data, EXTR_SKIP);
		
		$createZip  = zipped();

		if (isset($dir_backup) && count($dir_backup)>0)
		{
		
			// Lets backup any files or folders if any
		
			foreach ($dir_backup as $dir)
			{
				$basename = basename($dir);
		
				// dir basename
				if (is_file($dir))
				{
					$fileContents = file_get_contents($dir);
					$createZip->addFile($fileContents,$basename);
				}
				else
				{
		
					$createZip->addDirectory($basename."/");
		
					$files = directoryToArray($dir,true);
		
					$files = array_reverse($files);
		
					foreach ($files as $file)
					{
		
						$zipPath = explode($dir,$file);
						$zipPath = $zipPath[1];
		
						// skip any if required
		
						$skip =  false;
						foreach ($dir_skip as $skipObject)
						{
							if (strpos($file,$skipObject) === 0)
							{
								$skip = true;
								break;
							}
						}
		
						if ($skip) {
							continue;
						}
		
		
						if (is_dir($file))
						{
							$createZip->addDirectory($basename."/".$zipPath);
						}
						else
						{
							$fileContents = file_get_contents($file);
							$createZip->addFile($fileContents,$basename."/".$zipPath);
						}
					}
				}
		
			}
		
		}	
		
		if(isset($inc_db)){
			$sqldump = dumpDB('*');
			$createZip->addFile($sqldump,$iw->db_name.'.sql');
		}
		
		$fileName 	= $dir_store.$backup_name;
		$fd 		= fopen ($fileName, "wb");
		$out 		= fwrite($fd, $createZip->getZippedfile());
		fclose($fd);
	}
}

if(!function_exists('save_zipped')){
	function save_zipped($data){
		save_to_file($data);
	}
}

if(!function_exists('backup_download')){
	function backup_download($dirname,$filename){
		$msg 	= array();
		$file 	= $dirname.$filename;
		if(file_exists($file)){
		//  && !eregi( "p?html?", $vFile ) && !eregi( "inc", $vFile ) && !eregi( "php3?", $vFile )
			$size = filesize($file);
			header("Content-Type: application/save");
			header("Content-Length: $size");
			header("Content-Disposition: attachment; filename=\"$filename\"");
			header("Content-Transfer-Encoding: binary");
			if ($fh = fopen("$file", "rb")){
				fpassthru($fh);
				fclose($fh);
			} else $msg[] ='<strong>ERROR</strong>: Read denied :'.$file;
		} else $msg[] ='<strong>ERROR</strong>: file not found :'.$file;
		
		if($msg){
			foreach($msg as $error) _e('<div id="error">'.$error.'</div>');
		}else{
			_e('<div id="success"><strong>SUCCESS</strong>: Opsi General berhasil di perbaharui</div>');
		}
	}
}

if(!function_exists('file_timeout')){
	function file_timeout(){
		$file 		= get_option('backup_file');
		
		if(!empty($file)){
		$file 		= explode('#',$file);
		foreach($file as $key)	{
		$file 		= explode('::',$key);	
		$time_end 	= $file[1];
		$file    	= Tmp.$file[0].'.zip';
		
		if( file_exists($file) ){
			if(time() > $time_end){
				@unlink($file);
			}			
			$up.= $key.'#';
		}}
			set_option('backup_file',$up);
		}
	}
}

if(!function_exists('save_file')){
	function save_file($data){
		global $db;
		extract($data, EXTR_SKIP);
		
		if(!empty( $encrypt ) || $encrypt == 1) $backup_name = md5($name);
		else $backup_name = $name;
		if(!empty( $inc_db ) || $inc_db == 1) $inc_db = true;
		
		if( empty( $name ) ) _e('<div id="error"><strong>ERROR</strong>: The name is empty</div>');
		if( empty( $timeout ) ) _e('<div id="error"><strong>ERROR</strong>: The time out is empty</div>');
			
		$val  			= $backup_name.'::'.(time()+$timeout).'#';			
		$backup_file 	= get_option('backup_file');
		
		if( !$backup_file ) add_option('backup_file',$val);		
		if( !empty($backup_file) || empty($backup_file) ) set_option('backup_file',$backup_file.$val);
			
		$backup_name	= $backup_name.'.zip';	
		$data = compact('dir_backup','dir_skip','dir_store','backup_name','inc_db');
		save_zipped($data);
	}
}

?>