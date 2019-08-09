<?php
switch($_GET['v']){
default:
case'daftar-peringkat':
include "output/output-daftar-peringkat.php";
break;
case'detail-nilai-peringkat':
include "output/output-detail-nilai-peringkat.php";
break;
}
?>