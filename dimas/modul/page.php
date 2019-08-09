<?php
switch($_GET[act]){
default:
?>
<div id="box-head">Error 404</div>
<div id="box-content">Page is empty</div>
<?php
break;
case 'kk':

if( isset($_POST[simpan]) ){
	$c1 = $_POST[c1];
	$c2 = $_POST[c2];
	$c3 = $_POST[c3];
	$c4 = $_POST[c4];
	
	$b1 = $_POST[b1];
	$b2 = $_POST[b2];
	$b3 = $_POST[b3];
	$b4 = $_POST[b4];
	
	$a1 = $_POST[a1];
	$a2 = $_POST[a2];
	$a3 = $_POST[a3];
	$a4 = $_POST[a4];
	
	$running.= mysql_query("UPDATE kandidat SET nama = '$a1' WHERE kode = 'A1'");
	$running.= mysql_query("UPDATE kandidat SET nama = '$a2' WHERE kode = 'A2'");
	$running.= mysql_query("UPDATE kandidat SET nama = '$a3' WHERE kode = 'A3'");
	$running.= mysql_query("UPDATE kandidat SET nama = '$a4' WHERE kode = 'A4'");
	
	$running.= mysql_query("UPDATE kriteria SET nama = '$c1', bobot = '$b1' WHERE kode = 'C1'");
	$running.= mysql_query("UPDATE kriteria SET nama = '$c2', bobot = '$b2' WHERE kode = 'C2'");
	$running.= mysql_query("UPDATE kriteria SET nama = '$c3', bobot = '$b3' WHERE kode = 'C3'");
	$running.= mysql_query("UPDATE kriteria SET nama = '$c4', bobot = '$b4' WHERE kode = 'C4'");
}

?>
<div id="box-head">Kriteria & Kandidat</div>
<div id="box-content">
<form action="" method="post">
  <table width="100%" border="0" cellspacing="2" cellpadding="2">
    <tr>
      <td>Kriteria Penilaian</td>
      <td>Bobot Kriteria</td>
      <td>Kandidat</td>
    </tr>
    <tr>
      <td>C1 = <input name="c1" type="text" id="c1" size="30" value="<?php echo kriteria_by_kode('C1');?>"></td>
      <td><input name="b1" type="text" id="b1" size="6" value="<?php echo kriteria_by_kode('C1','bobot');?>"> %</td>
      <td>A1 = <input name="a1" type="text" id="a1" size="30" value="<?php echo kandidat_by_kode('A1');?>"></td>
    </tr>
    <tr>
      <td>C2 = <input name="c2" type="text" id="c2" size="30" value="<?php echo kriteria_by_kode('C2');?>"></td>
      <td><input name="b2" type="text" id="b2" size="6" value="<?php echo kriteria_by_kode('C2','bobot');?>"> %</td>
      <td>A2 = <input name="a2" type="text" id="a2" size="30" value="<?php echo kandidat_by_kode('A2');?>"></td>
    </tr>
    <tr>
      <td>C3 = <input name="c3" type="text" id="c3" size="30" value="<?php echo kriteria_by_kode('C3');?>"></td>
      <td><input name="b3" type="text" id="b3" size="6" value="<?php echo kriteria_by_kode('C3','bobot');?>"> %</td>
      <td>A3 = <input name="a3" type="text" id="a3" size="30" value="<?php echo kandidat_by_kode('A3');?>"></td>
    </tr>
    <tr>
      <td>C4 = <input name="c4" type="text" id="c4" size="30" value="<?php echo kriteria_by_kode('C4');?>"></td>
      <td><input name="b4" type="text" id="b4" size="6" value="<?php echo kriteria_by_kode('C4','bobot');?>"> %</td>
      <td>A4 = <input name="a4" type="text" id="a4" size="30" value="<?php echo kandidat_by_kode('A4');?>"></td>
    </tr>
  </table>
  <input type="submit" name="simpan" value="Simpan">
</form>
</div>
<?php
break;
case 'about':
?>
<div id="box-head">Tentang saya</div>
<div id="box-content">
halaman xx
</div>
<?php
break;
}
?>