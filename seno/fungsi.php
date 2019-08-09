<?php

function cek_login(){
	$username = $_SESSION['username'];
	$password = $_SESSION['password'];
	
	$mysql_query = mysql_query("SELECT * FROM users WHERE username='".$username."' AND password='".$password."'");
	$mysql_num = mysql_num_rows($mysql_query);
	
	if( $mysql_num > 0 ) return true;
	else return false;
	
}

function set_login($username,$password){
	
	$mysql_query = mysql_query("SELECT * FROM users WHERE username='".$username."' AND password='".$password."'");
	$mysql_num = mysql_num_rows($mysql_query);
	$mysql_row = mysql_fetch_array($mysql_query);
	
	if( $mysql_num > 0 ){
		
		$_SESSION['userid'] = $mysql_row['user_id'];
		$_SESSION['username'] = $mysql_row['username'];
		$_SESSION['password'] = $mysql_row['password'];
		
		echo redirect_to();
		
	}else{
		echo "Username dan Password salah";
	}
	
}

function logout(){
		
	unset($_SESSION['userid']);
	unset($_SESSION['username']);
	unset($_SESSION['password']);
	
	echo redirect_to();
}

function get_uname_id(){
	$uname = $_SESSION['userid'];
	return $uname;
	
}

function get_uname_name($string){
	$uname = $_SESSION['username'];
	return $uname."_".$string;
	
}

function redirect_to( $redirect = "" ){		
		return "<meta http-equiv=\"Refresh\" content=\"0; url=$redirect\"/>";
}

function matrik_id($id,$jenis = 'alternatif'){
	$user_id = get_uname_id();
	$query_alternatif = mysql_query("SELECT * FROM `matrik` WHERE jenis='$jenis' AND user_id='$user_id' AND id_matrik='$id'");
	$row_alternatif = mysql_fetch_object($query_alternatif);
	return $row_alternatif->matrik_value;
}

function list_npm_op($op_link = false){
	if( empty($op_link) ) $link = '?sis=input&v=alternatif'; 
	else $link = $op_link;
	
	$query_npm = mysql_query("SELECT * FROM mahasiswa");
	while($row_npm = mysql_fetch_object($query_npm)){
		$selected  = "";
		if( $row_npm->npm == $_GET['npm']) $selected = 'selected="selected"';
		echo '<option value="'.$link.'&npm='.$row_npm->npm.'" '.$selected.'>'.$row_npm->npm.'</option>';
	}
}

function js_redirect() {
	return '<script language="javascript">function redir(mylist){ if (newurl=mylist.options[mylist.selectedIndex].value)document.location=newurl;}</script>'."\n";
}

function get_kandidat($param){
	$user_id = get_uname_id();
	$kandidat = array();
	$query_kandidat = mysql_query("SELECT * FROM kandidat WHERE user_id='$user_id'");
	while($row_kandidat = mysql_fetch_object($query_kandidat)){
		$kandidat[] = $row_kandidat->nama;
	}
	return $kandidat[$param];
	
}

function array_sort($array, $on, $order = SORT_ASC){
	$new_array = $sortable_array = array();
	if( count($array) > 0 ){
		foreach( $array as $k => $v ){
			if(is_array($v)){
				foreach($v as $k2 => $v2){
					if( $k2 == $on ){
						$sortable_array[$k] = $v2;;
					}
				}
			}else{
				$sortable_array[$k] = $v;
			}
		}
		switch( $order ){
			case SORT_ASC:
				asort($sortable_array);
				break;
			case SORT_DESC:
				arsort($sortable_array);
				break;
		}
		foreach($sortable_array as $k => $v){
			$new_array[$k] = $array[$k];
		}
	}
	return $new_array;
}


function uploader($data){
		extract($data, EXTR_SKIP);
		
		$myfile_name = $myfile['name'];
		$myfile_temp = $myfile['tmp_name'];
		$uploadFile  = $uploadDir . basename($myfile_name);
		
        if (move_uploaded_file($myfile_temp, $uploadFile)) {
            echo '<div id="success">File successfully uploaded!</div>';
			return true;
        } else {
			$msg = array();
            switch ($myfile['error']) {
                case 1:
                    $msg[]= 'The file is bigger than this PHP installation allows';
                    break;
                case 2:
                    $msg[]= 'The file is bigger than this form allows';
                    break;
                case 3:
                    $msg[]= 'Only part of the file was uploaded';
                    break;
                case 4:
                    $msg[]= 'No file was uploaded';
                    break;
                default:
                    $msg[]= 'unknown error';
            }
			if( is_array($msg))	{
			foreach($msg as $val){
				echo '<div id="error">'.$val.' </div>';
			}
		}}
}