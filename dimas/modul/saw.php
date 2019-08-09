<div id="box-head">Matrik Alternatif</div>
<div id="box-content">
<?php
if( isset($_POST['proses']) ):

$n[]  = $_POST[n1];
$n[]  = $_POST[n2];
$n[]  = $_POST[n3];
$n[]  = $_POST[n4];

$n[]  = $_POST[n5];
$n[]  = $_POST[n6];
$n[]  = $_POST[n7];
$n[]  = $_POST[n8];

$n[]  = $_POST[n9];
$n[] = $_POST[n10];
$n[] = $_POST[n11];
$n[] = $_POST[n12];

$n[] = $_POST[n13];
$n[] = $_POST[n14];
$n[] = $_POST[n15];
$n[] = $_POST[n16];

foreach( $n as $k => $v ){
	$nilai_id = $k + 1;
	$running= mysql_query("UPDATE nilai SET angka = '$v' WHERE nilai_id = '$nilai_id'");
}

$show = true;
endif;
?>
<form action="" method="post">
  <table width="100%" border="0" cellspacing="2" cellpadding="2">
    <tr>
      <td width="24%" rowspan="2" align="center" valign="middle"><strong>Alternatif</strong></td>
      <td colspan="4" align="center" valign="middle"><strong>Kriteria</strong></td>
      </tr>
    <tr>
      <td width="10%" align="center" valign="middle"><strong>C1</strong></td>
      <td width="10%" align="center" valign="middle"><strong>C2</strong></td>
      <td width="10%" align="center" valign="middle"><strong>C3</strong></td>
      <td width="10%" align="center" valign="middle"><strong>C4</strong></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><?php echo kandidat_by_kode('A1');?></td>
      <td width="10%" align="center" valign="middle"><input name="n1" type="text" id="n1" size="8" value="<?php echo $_POST[n1];?>"></td>
      <td width="10%" align="center" valign="middle"><input name="n5" type="text" id="n5" size="8" value="<?php echo $_POST[n5];?>"></td>
      <td width="10%" align="center" valign="middle"><input name="n9" type="text" id="n9" size="8" value="<?php echo $_POST[n9];?>"></td>
      <td width="10%" align="center" valign="middle"><input name="n13" type="text" id="n13" size="8" value="<?php echo $_POST[n13];?>"></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><?php echo kandidat_by_kode('A2');?></td>
      <td width="10%" align="center" valign="middle"><input name="n2" type="text" id="n2" size="8" value="<?php echo $_POST[n2];?>"></td>
      <td width="10%" align="center" valign="middle"><input name="n6" type="text" id="n6" size="8" value="<?php echo $_POST[n6];?>"></td>
      <td width="10%" align="center" valign="middle"><input name="n10" type="text" id="n10" size="8" value="<?php echo $_POST[n10];?>"></td>
      <td width="10%" align="center" valign="middle"><input name="n14" type="text" id="n14" size="8" value="<?php echo $_POST[n14];?>"></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><?php echo kandidat_by_kode('A3');?></td>
      <td width="10%" align="center" valign="middle"><input name="n3" type="text" id="n3" size="8" value="<?php echo $_POST[n3];?>"></td>
      <td width="10%" align="center" valign="middle"><input name="n7" type="text" id="n7" size="8" value="<?php echo $_POST[n7];?>"></td>
      <td width="10%" align="center" valign="middle"><input name="n11" type="text" id="n11" size="8" value="<?php echo $_POST[n11];?>"></td>
      <td width="10%" align="center" valign="middle"><input name="n15" type="text" id="n15" size="8" value="<?php echo $_POST[n15];?>"></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><?php echo kandidat_by_kode('A4');?></td>
      <td width="10%" align="center" valign="middle"><input name="n4" type="text" id="n4" size="8" value="<?php echo $_POST[n4];?>"></td>
      <td width="10%" align="center" valign="middle"><input name="n8" type="text" id="n8" size="8" value="<?php echo $_POST[n8];?>"></td>
      <td width="10%" align="center" valign="middle"><input name="n12" type="text" id="n12" size="8" value="<?php echo $_POST[n12];?>"></td>
      <td width="10%" align="center" valign="middle"><input name="n16" type="text" id="n16" size="8" value="<?php echo $_POST[n16];?>"></td>
    </tr>
  </table>
  <input type="submit" name="proses" value="Proses">
</form>
</div>
<?php
if( $show == true ):
?>
<br>
<div id="box-head">Hasil Matrik Alternatif</div>
<div id="box-content">
<?php
$n1  = normalisasi_lanjut(0,0);
$n2  = normalisasi_lanjut(4,4);
$n3  = normalisasi_lanjut(8,8);
$n4  = normalisasi_lanjut(12,12);

$n5  = normalisasi_lanjut(1,0);
$n6  = normalisasi_lanjut(5,4);
$n7  = normalisasi_lanjut(9,8);
$n8  = normalisasi_lanjut(13,12);

$n9  = normalisasi_lanjut(2,0);
$n10 = normalisasi_lanjut(6,4);
$n11 = normalisasi_lanjut(10,8);
$n12 = normalisasi_lanjut(14,12);

$n13 = normalisasi_lanjut(3,0);
$n14 = normalisasi_lanjut(7,4);
$n15 = normalisasi_lanjut(11,8);
$n16 = normalisasi_lanjut(15,12);

$v1  = perkalian_matrik($n1,$n2,$n3,$n4);
$v2  = perkalian_matrik($n5,$n6,$n7,$n8);
$v3  = perkalian_matrik($n9,$n10,$n11,$n12);
$v4  = perkalian_matrik($n13,$n14,$n15,$n16);
?>
  <table width="100%" border="0" cellspacing="2" cellpadding="2">
    <tr>
      <td width="24%" rowspan="2" align="center" valign="middle"><strong>Alternatif</strong></td>
      <td colspan="4" align="center" valign="middle"><strong>Kriteria</strong></td>
      <td width="10%" rowspan="2" align="center" valign="middle"><strong>V</strong></td>
      </tr>
    <tr>
      <td width="10%" align="center" valign="middle"><strong>C1 <?php echo kriteria_by_kode('C1','bobot');?>%</strong></td>
      <td width="10%" align="center" valign="middle"><strong>C2 <?php echo kriteria_by_kode('C2','bobot');?>%</strong></td>
      <td width="10%" align="center" valign="middle"><strong>C3 <?php echo kriteria_by_kode('C3','bobot');?>%</strong></td>
      <td width="10%" align="center" valign="middle"><strong>C4 <?php echo kriteria_by_kode('C4','bobot');?>%</strong></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><?php echo kandidat_by_kode('A1');?></td>
      <td width="10%" align="center" valign="middle"><?php echo round($n1,2);?></td>
      <td width="10%" align="center" valign="middle"><?php echo round($n2,2);?></td>
      <td width="10%" align="center" valign="middle"><?php echo round($n3,2);?></td>
      <td width="10%" align="center" valign="middle"><?php echo round($n4,2);?></td>
      <td width="10%" align="center" valign="middle"><?php echo round($v1,2);?></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><?php echo kandidat_by_kode('A2');?></td>
      <td width="10%" align="center" valign="middle"><?php echo round($n5,2);?></td>
      <td width="10%" align="center" valign="middle"><?php echo round($n6,2);?></td>
      <td width="10%" align="center" valign="middle"><?php echo round($n7,2);?></td>
      <td width="10%" align="center" valign="middle"><?php echo round($n8,2);?></td>
      <td width="10%" align="center" valign="middle"><?php echo round($v2,2);?></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><?php echo kandidat_by_kode('A3');?></td>
      <td width="10%" align="center" valign="middle"><?php echo round($n9,2);?></td>
      <td width="10%" align="center" valign="middle"><?php echo round($n10,2);?></td>
      <td width="10%" align="center" valign="middle"><?php echo round($n11,2);?></td>
      <td width="10%" align="center" valign="middle"><?php echo round($n12,2);?></td>
      <td width="10%" align="center" valign="middle"><?php echo round($v3,2);?></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><?php echo kandidat_by_kode('A4');?></td>
      <td width="10%" align="center" valign="middle"><?php echo round($n13,2);?></td>
      <td width="10%" align="center" valign="middle"><?php echo round($n14,2);?></td>
      <td width="10%" align="center" valign="middle"><?php echo round($n15,2);?></td>
      <td width="10%" align="center" valign="middle"><?php echo round($n16,2);?></td>
      <td width="10%" align="center" valign="middle"><?php echo round($v4,2);?></td>
    </tr>
  </table>
</div>
<?php
endif;
?>