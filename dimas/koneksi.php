<?php
$connect = mysql_connect("localhost","root","");

if (!$connect){ 
	die('Could not connect: ' . mysql_error());
}

mysql_select_db("private_dimas", $connect) or die("DATABASE Gagal ditemukan");
?>