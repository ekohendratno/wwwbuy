<?php
error_reporting(0);
session_start();
include "koneksi.php";
include "fungsi.php";

global $content_view;
ob_start();

if( isset($_GET['logout']) && cek_login() ) logout();

if( cek_login() ){	
	if( !empty($_GET['sis']) && $_GET['sis'] == 'input' || $_GET['sis'] == 'output' &&
	file_exists("modul/".$_GET['sis'].".php") ){
		include "modul/".$_GET['sis'].".php";
	}else include "ui/home.php";
}else include "modul/welcome.php";

$content_view = ob_get_contents();
ob_end_clean();

include 'ui/index.php';



