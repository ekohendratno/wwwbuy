<?php
switch($_GET['v']){
default:
case'alternatif':
include "input/input-alternatif.php";
break;
case'kriteria':
include "input/input-kriteria.php";
break;
case'mahasiswa':
include "input/input-mahasiswa.php";
break;
case'nilai-perbandingan-alternatif':
include "input/input-nilai-perbandingan-alternatif.php";
break;
case'nilai-perbandingan-kriteria':
include "input/input-nilai-perbandingan-kriteria.php";
break;
}
?>