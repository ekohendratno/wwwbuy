<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="ui/style.css" type="text/css" media="all">
<link rel="stylesheet" href="ui/forms.css" type="text/css" media="all">
<title>SIS SENO</title>
</head>

<body>

<div id="wrapper">
<div id="header">
<img class="logo" src="ui/images/logo_akper_pancabakti.png">
<div class="header_text">Sistem Informasi Seleksi Mahasiswa<br>Berprestasi Akper Panca Bakti</div>
</div>
<div id="menu_nav">
<ul>
<li><a href="./"><span>Home</span></a></li>
<?php if(cek_login()){?>
<li><a href="./?sis=input&v=nilai-perbandingan-kriteria"><span>Data AHP</span></a></li>
<li><a href="./?sis=input&v=alternatif"><span>Input Alternatif</span></a></li>
<li><a href="./?sis=input&v=nilai-perbandingan-alternatif"><span>Data Alternatif</span></a></li>
<li><a href="./?logout"><span>Logout</span></a></li>
<?php }?>
</ul>
</div>
<div id="content_wrap">
<br style="clear:both">
<div id="sidebar">
<?php if(cek_login()){?>
<ul>
<li><a href="./?sis=output&v=daftar-peringkat">Daftar Peringkat</a></li>
<li><a href="./?sis=output&v=detail-nilai-peringkat">Detail Nilai Peringkat</a></li>
<li><a href="./?sis=input&v=mahasiswa">Profile Mahasiswa</a></li>
</ul>
<?php 
}else{
	  
	  if( isset($_POST['masuk']) ){
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		if( empty($username) ) echo "<div class=\"error\">Username tidak boleh kosong</div>";
		elseif( empty($password) ) echo "<div class=\"error\">Password tidak boleh kosong</div>"; 
		else set_login($username,$password);
	  }
?>
      <form method="post" action="">
        <table width="100%" border="0" align="center" bordercolor="#000000" style="border:none">
          <tr>
            <td height="21" colspan="2" align="left" bordercolor="#FFFF00"><u><strong>Masuk disini</strong></u></td>
          </tr>
          <tr>
            <td width="96" height="25" align="left" bordercolor="#FFFF00"><div align="left">Username</div></td>
            <td width="909" align="left" bordercolor="#FFFF00"><label>
              <input name="username" type="text" style="text-align:left; width:90%" />
            </label></td>
          </tr>
          <tr>
            <td height="24" align="left" bordercolor="#FFFF00"><div align="left">Password</div></td>
            <td align="left" bordercolor="#FFFF00">
              <label>
                <input name="password" type="password" style="text-align:left; width:90%"/>
              </label></td>
          </tr>
          <tr>
            <td height="26" colspan="2" align="left" bordercolor="#FFFF00"><label></label>
              <label>
                <input name="masuk" type="submit" value="masuk" />
              </label></td>
          </tr>
        </table>
      
</form>
<?php }?>
</div>
<div id="content">
<?php echo $content_view;?>
</div>
<br style="clear:both">
<div id="footer">
Akper Panca Bakti
</div>

</div>

</body>
</html>