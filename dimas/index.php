<?php
error_reporting(0);
include "koneksi.php";
include "fungsi.php";?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dimas SAW</title>
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all">
</head>

<body>

<div id="header">
    <div class="wrapper">
        <div id="logo">
            <img src="images/logo.png">
            <div class="logo1">DIMAS WEB</div>
            <div class="logo2">Perancangan Sistem dengan SAW</div>
        </div>
    </div>
</div>
<div id="header-menus">
    <div class="wrapper">
        <div class="menus">
            <ul>
                <li><a href="./">HALAMAN UTAMA</a></li>
                <li><a href="./?m=page&act=kk">KRITERIA & KANDIDAT</a></li>
                <li><a href="./?m=page&act=about">TENTANG SAYA</a></li>
            </ul>
        </div>
    </div>
</div>
<div id="content">
    <div class="wrapper">
        <div class="content-bg">
            <?php
            if( isset($_GET['m']) && !empty($_GET['m']) ){
                include "modul/".$_GET['m'].".php";
            }else{
                include "modul/front.php";
            }
            ?>
            <div style="clear:both"></div>
        </div>
    </div>
</div>
<div id="footer">
    <div class="wrapper">
        <div class="footer-bg">&copy; 2014 DIMAS WEB &bull; All right reserved</div>
    </div>
</div>

</body>
</html>
