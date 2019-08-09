<div class="content_header">Matrik Alternatif</div>
<?php
if( isset($_POST['submit']) ){
	/*
	 * A
	 */
	$mak1a = $_POST['mak1a'];
	$mak2a = $_POST['mak2a'];
	$mak3a = $_POST['mak3a'];	
	//==================================
	$hmak1a = (1/$mak1a);
	$hmak2a = (1/$mak2a);
	$hmak3a = (1/$mak3a);
	//==================================
	$thmakaa = (1+$hmak1a+$hmak2a);
	$thmakba = (1+$mak1a+$hmak3a);
	$thmakca = (1+$mak2a+$mak3a);
	//==================================
	$vhmak1a 	= (1/$thmakaa);
	$vhmak2a 	= ($hmak1a/$thmakaa);
	$vhmak3a 	= ($hmak2a/$thmakaa);	
	
	$vhmak4a 	= ($mak1a/$thmakba);
	$vhmak5a 	= (1/$thmakba);
	$vhmak6a 	= ($hmak3a/$thmakba);
		
	$vhmak7a 	= ($mak2a/$thmakca);
	$vhmak8a 	= ($mak3a/$thmakca);
	$vhmak9a 	= (1/$thmakca);
	
	$ev1a = (($vhmak1a+$vhmak4a+$vhmak7a)/3);
	$ev2a = (($vhmak2a+$vhmak5a+$vhmak8a)/3);
	$ev3a = (($vhmak3a+$vhmak6a+$vhmak9a)/3);
	
	//==================================
	$thmaka_a = ($vhmak1a+$vhmak2a+$vhmak3a);
	$thmakb_a = ($vhmak4a+$vhmak5a+$vhmak6a);
	$thmakc_a = ($vhmak7a+$vhmak8a+$vhmak9a);
	
	$evtota = ($ev1a+$ev2a+$ev3a);
	
	/*
	 * B
	 */
	$mak1b = $_POST['mak1b'];
	$mak2b = $_POST['mak2b'];
	$mak3b = $_POST['mak3b'];	
	//==================================
	$hmak1b = (1/$mak1b);
	$hmak2b = (1/$mak2b);
	$hmak3b = (1/$mak3b);
	//==================================
	$thmakab = (1+$hmak1b+$hmak2b);
	$thmakbb = (1+$mak1b+$hmak3b);
	$thmakcb = (1+$mak2b+$mak3b);
	//==================================
	$vhmak1b 	= (1/$thmakab);
	$vhmak2b 	= ($hmak1b/$thmakab);
	$vhmak3b 	= ($hmak2b/$thmakab);	
	
	$vhmak4b 	= ($mak1b/$thmakbb);
	$vhmak5b 	= (1/$thmakbb);
	$vhmak6b 	= ($hmak3b/$thmakbb);
		
	$vhmak7b 	= ($mak2b/$thmakcb);
	$vhmak8b 	= ($mak3b/$thmakcb);
	$vhmak9b 	= (1/$thmakcb);
	
	$ev1b = (($vhmak1b+$vhmak4b+$vhmak7b)/3);
	$ev2b = (($vhmak2b+$vhmak5b+$vhmak8b)/3);
	$ev3b = (($vhmak3b+$vhmak6b+$vhmak9b)/3);
	
	//==================================
	$thmaka_b = ($vhmak1b+$vhmak2b+$vhmak3b);
	$thmakb_b = ($vhmak4b+$vhmak5b+$vhmak6b);
	$thmakc_b = ($vhmak7b+$vhmak8b+$vhmak9b);
	
	$evtotb = ($ev1b+$ev2b+$ev3b);

	/*
	 * C
	 */
	$mak1c = $_POST['mak1c'];
	$mak2c = $_POST['mak2c'];
	$mak3c = $_POST['mak3c'];	
	//==================================
	$hmak1c = (1/$mak1c);
	$hmak2c = (1/$mak2c);
	$hmak3c = (1/$mak3c);
	//==================================
	$thmakac = (1+$hmak1c+$hmak2c);
	$thmakbc = (1+$mak1c+$hmak3c);
	$thmakcc = (1+$mak2c+$mak3c);
	//==================================
	$vhmak1c 	= (1/$thmakac);
	$vhmak2c 	= ($hmak1c/$thmakac);
	$vhmak3c 	= ($hmak2c/$thmakac);	
	
	$vhmak4c 	= ($mak1c/$thmakbc);
	$vhmak5c 	= (1/$thmakbc);
	$vhmak6c 	= ($hmak3c/$thmakbc);
		
	$vhmak7c 	= ($mak2c/$thmakcc);
	$vhmak8c 	= ($mak3c/$thmakcc);
	$vhmak9c 	= (1/$thmakcc);
	
	$ev1c = (($vhmak1c+$vhmak4c+$vhmak7c)/3);
	$ev2c = (($vhmak2c+$vhmak5c+$vhmak8c)/3);
	$ev3c = (($vhmak3c+$vhmak6c+$vhmak9c)/3);
	
	//==================================
	$thmaka_c = ($vhmak1c+$vhmak2c+$vhmak3c);
	$thmakb_c = ($vhmak4c+$vhmak5c+$vhmak6c);
	$thmakc_c = ($vhmak7c+$vhmak8c+$vhmak9c);
	
	$evtotc = ($ev1c+$ev2c+$ev3c);

	/*
	 * D
	 */
	$mak1d = $_POST['mak1d'];
	$mak2d = $_POST['mak2d'];
	$mak3d = $_POST['mak3d'];	
	//==================================
	$hmak1d = (1/$mak1d);
	$hmak2d = (1/$mak2d);
	$hmak3d = (1/$mak3d);
	//==================================
	$thmakad = (1+$hmak1d+$hmak2d);
	$thmakbd = (1+$mak1d+$hmak3d);
	$thmakcd = (1+$mak2d+$mak3d);
	//==================================
	$vhmak1d 	= (1/$thmakad);
	$vhmak2d 	= ($hmak1d/$thmakad);
	$vhmak3d 	= ($hmak2d/$thmakad);	
	
	$vhmak4d 	= ($mak1d/$thmakbd);
	$vhmak5d 	= (1/$thmakbd);
	$vhmak6d 	= ($hmak3d/$thmakbd);
		
	$vhmak7d 	= ($mak2d/$thmakcd);
	$vhmak8d 	= ($mak3d/$thmakcd);
	$vhmak9d 	= (1/$thmakcd);
	
	$ev1d = (($vhmak1d+$vhmak4d+$vhmak7d)/3);
	$ev2d = (($vhmak2d+$vhmak5d+$vhmak8d)/3);
	$ev3d = (($vhmak3d+$vhmak6d+$vhmak9d)/3);
	
	//==================================
	$thmaka_d = ($vhmak1d+$vhmak2d+$vhmak3d);
	$thmakb_d = ($vhmak4d+$vhmak5d+$vhmak6d);
	$thmakc_d = ($vhmak7d+$vhmak8d+$vhmak9d);
	
	$evtotd = ($ev1d+$ev2d+$ev3d);
	
	$ev = array(
	$ev1a,$ev2a,$ev3a,
	$ev1b,$ev2b,$ev3b,
	$ev1c,$ev2c,$ev3c,
	$ev1d,$ev2d,$ev3d);
	
	$run_update = $run_insert = '';
		
	$user_id = get_uname_id();
	
	$select_pa = mysql_query("SELECT * FROM `matrik`  WHERE  `jenis` =  'alternatif' AND  `user_id` =  '$user_id'");
	$num_pa = mysql_num_rows($select_pa);
	
	if( $num_pa > 0 ){	
		$i=0;
		while( $row_pa = mysql_fetch_object($select_pa) ){
		$evx = $ev[$i];
		$run_update.= mysql_query("UPDATE  `matrik` SET  `matrik_value` =  '$evx' WHERE  `id_matrik` =  '$row_pa->id_matrik' AND `jenis` =  'alternatif' AND `user_id` = '$user_id'");
		$i++;
		}
	}else{
		for($i=0; $i<=11; $i++){
		$evx = $ev[$i];
		$run_insert.= mysql_query("INSERT INTO `matrik` (`id_matrik`, `user_id`, `matrik_value`,`jenis`) VALUES ('$i','$user_id', '$evx','alternatif')");
		}
	}
	
	if( $run_update ) echo "<div class=\"sukses\">Berhasil di perbaharui</div><br>";
	elseif( $run_insert ) echo "<div class=\"sukses\">Berhasil di tambahkan</div><br>";
	else echo "<div class=\"error\">Gagal disimpan</div><br>";
}
?>
<form method="post" action="">
<div class="content_header">Matrik Alternatif Kepribadian</div>
    <table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td>&nbsp;</td>
        <td align="center"><?php echo get_kandidat(0);?></td>
        <td align="center"><?php echo get_kandidat(1);?></td>
        <td align="center"><?php echo get_kandidat(2);?></td>
      </tr>
      <tr>
        <td><?php echo get_kandidat(0);?></td>
        <td align="center" bgcolor="#CCCCCC">1</td>
        <td align="center">
        <input type="text" name="mak1a" id="mak1a" value="<?php echo $_POST['mak1a']?>" /></td>
        <td align="center">
        <input type="text" name="mak2a" id="mak2a" value="<?php echo $_POST['mak2a']?>" /></td>
      </tr>
      <tr>
        <td><?php echo get_kandidat(1);?></td>
        <td align="center"><?php echo round($hmak1a,2)?></td>
        <td align="center" bgcolor="#CCCCCC">1</td>
        <td align="center">
        <input type="text" name="mak3a" id="mak3a" value="<?php echo $_POST['mak3a']?>" /></td>
      </tr>
      <tr>
        <td><?php echo get_kandidat(2);?></td>
        <td align="center"><?php echo round($hmak2a,2)?></td>
        <td align="center"><?php echo round($hmak3a,2)?></td>
        <td align="center" bgcolor="#CCCCCC">1</td>
      </tr>
      <tr>
        <td>&sum;</td>
        <td align="center"><?php echo round($thmakaa,2)?></td>
        <td align="center"><?php echo round($thmakba,2)?></td>
        <td align="center"><?php echo round($thmakca,2)?></td>
      </tr>
    </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td>&nbsp;</td>
        <td align="center"><?php echo get_kandidat(0);?></td>
        <td align="center"><?php echo get_kandidat(1);?></td>
        <td align="center"><?php echo get_kandidat(2);?></td>
        <td align="center">Eigen Vektor</td>
      </tr>
      <tr>
        <td><?php echo get_kandidat(0);?></td>
        <td align="center" bgcolor="#CCCCCC"><?php echo round($vhmak1a,2)?></td>
        <td align="center"><?php echo round($vhmak4a,2)?></td>
        <td align="center"><?php echo round($vhmak7a,2)?></td>
        <td align="center"><?php echo round($ev1a,2)?></td>
      </tr>
      <tr>
        <td><?php echo get_kandidat(1);?></td>
        <td align="center"><?php echo round($vhmak2a,2)?></td>
        <td align="center" bgcolor="#CCCCCC"><?php echo round($vhmak5a,2)?></td>
        <td align="center"><?php echo round($vhmak8a,2)?></td>
        <td align="center"><?php echo round($ev2a,2)?></td>
      </tr>
      <tr>
        <td><?php echo get_kandidat(0);?></td>
        <td align="center"><?php echo round($vhmak3a,2)?></td>
        <td align="center"><?php echo round($vhmak6a,2)?></td>
        <td align="center" bgcolor="#CCCCCC"><?php echo round($vhmak9a,2)?></td>
        <td align="center"><?php echo round($ev3a,2)?></td>
      </tr>
      <tr>
        <td>&sum;</td>
        <td align="center"><?php echo round($thmaka_a,2)?></td>
        <td align="center"><?php echo round($thmakb_a,2)?></td>
        <td align="center"><?php echo round($thmakc_a,2)?></td>
        <td align="center"><?php echo round($evtota,2)?></td>
      </tr>
    </table>
<div class="content_header">Matrik Alternatif Komunikasi</div>
    <table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td>&nbsp;</td>
        <td align="center"><?php echo get_kandidat(0);?></td>
        <td align="center"><?php echo get_kandidat(1);?></td>
        <td align="center"><?php echo get_kandidat(2);?></td>
      </tr>
      <tr>
        <td><?php echo get_kandidat(0);?></td>
        <td align="center" bgcolor="#CCCCCC">1</td>
        <td align="center">
        <input type="text" name="mak1b" id="mak1b" value="<?php echo $_POST['mak1b']?>" /></td>
        <td align="center">
        <input type="text" name="mak2b" id="mak2b" value="<?php echo $_POST['mak2b']?>" /></td>
      </tr>
      <tr>
        <td><?php echo get_kandidat(1);?></td>
        <td align="center"><?php echo round($hmak1b,2)?></td>
        <td align="center" bgcolor="#CCCCCC">1</td>
        <td align="center">
        <input type="text" name="mak3b" id="mak3b" value="<?php echo $_POST['mak3b']?>" /></td>
      </tr>
      <tr>
        <td><?php echo get_kandidat(2);?></td>
        <td align="center"><?php echo round($hmak2b,2)?></td>
        <td align="center"><?php echo round($hmak3b,2)?></td>
        <td align="center" bgcolor="#CCCCCC">1</td>
      </tr>
      <tr>
        <td>&sum;</td>
        <td align="center"><?php echo round($thmakab,2)?></td>
        <td align="center"><?php echo round($thmakbb,2)?></td>
        <td align="center"><?php echo round($thmakcb,2)?></td>
      </tr>
    </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td>&nbsp;</td>
        <td align="center"><?php echo get_kandidat(0);?></td>
        <td align="center"><?php echo get_kandidat(1);?></td>
        <td align="center"><?php echo get_kandidat(2);?></td>
        <td align="center">Eigen Vektor</td>
      </tr>
      <tr>
        <td><?php echo get_kandidat(0);?></td>
        <td align="center" bgcolor="#CCCCCC"><?php echo round($vhmak1b,2)?></td>
        <td align="center"><?php echo round($vhmak4b,2)?></td>
        <td align="center"><?php echo round($vhmak7b,2)?></td>
        <td align="center"><?php echo round($ev1b,2)?></td>
      </tr>
      <tr>
        <td><?php echo get_kandidat(1);?></td>
        <td align="center"><?php echo round($vhmak2b,2)?></td>
        <td align="center" bgcolor="#CCCCCC"><?php echo round($vhmak5b,2)?></td>
        <td align="center"><?php echo round($vhmak8b,2)?></td>
        <td align="center"><?php echo round($ev2b,2)?></td>
      </tr>
      <tr>
        <td><?php echo get_kandidat(2);?></td>
        <td align="center"><?php echo round($vhmak3b,2)?></td>
        <td align="center"><?php echo round($vhmak6b,2)?></td>
        <td align="center" bgcolor="#CCCCCC"><?php echo round($vhmak9b,2)?></td>
        <td align="center"><?php echo round($ev3b,2)?></td>
      </tr>
      <tr>
        <td>&sum;</td>
        <td align="center"><?php echo round($thmaka_b,2)?></td>
        <td align="center"><?php echo round($thmakb_b,2)?></td>
        <td align="center"><?php echo round($thmakc_b,2)?></td>
        <td align="center"><?php echo round($evtotb,2)?></td>
      </tr>
    </table>

<div class="content_header">Matrik Alternatif Pengetahuan</div>
    <table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td>&nbsp;</td>
        <td align="center"><?php echo get_kandidat(0);?></td>
        <td align="center"><?php echo get_kandidat(1);?></td>
        <td align="center"><?php echo get_kandidat(2);?></td>
      </tr>
      <tr>
        <td><?php echo get_kandidat(0);?></td>
        <td align="center" bgcolor="#CCCCCC">1</td>
        <td align="center">
        <input type="text" name="mak1c" id="mak1c" value="<?php echo $_POST['mak1c']?>" /></td>
        <td align="center">
        <input type="text" name="mak2c" id="mak2c" value="<?php echo $_POST['mak2c']?>" /></td>
      </tr>
      <tr>
        <td><?php echo get_kandidat(1);?></td>
        <td align="center"><?php echo round($hmak1c,2)?></td>
        <td align="center" bgcolor="#CCCCCC">1</td>
        <td align="center">
        <input type="text" name="mak3c" id="mak3c" value="<?php echo $_POST['mak3c']?>" /></td>
      </tr>
      <tr>
        <td><?php echo get_kandidat(2);?></td>
        <td align="center"><?php echo round($hmak2c,2)?></td>
        <td align="center"><?php echo round($hmak3c,2)?></td>
        <td align="center" bgcolor="#CCCCCC">1</td>
      </tr>
      <tr>
        <td>&sum;</td>
        <td align="center"><?php echo round($thmakac,2)?></td>
        <td align="center"><?php echo round($thmakbc,2)?></td>
        <td align="center"><?php echo round($thmakcc,2)?></td>
      </tr>
    </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td>&nbsp;</td>
        <td align="center"><?php echo get_kandidat(0);?></td>
        <td align="center"><?php echo get_kandidat(1);?></td>
        <td align="center"><?php echo get_kandidat(2);?></td>
        <td align="center">Eigen Vektor</td>
      </tr>
      <tr>
        <td><?php echo get_kandidat(0);?></td>
        <td align="center" bgcolor="#CCCCCC"><?php echo round($vhmak1c,2)?></td>
        <td align="center"><?php echo round($vhmak4c,2)?></td>
        <td align="center"><?php echo round($vhmak7c,2)?></td>
        <td align="center"><?php echo round($ev1c,2)?></td>
      </tr>
      <tr>
        <td><?php echo get_kandidat(1);?></td>
        <td align="center"><?php echo round($vhmak2c,2)?></td>
        <td align="center" bgcolor="#CCCCCC"><?php echo round($vhmak5c,2)?></td>
        <td align="center"><?php echo round($vhmak8c,2)?></td>
        <td align="center"><?php echo round($ev2c,2)?></td>
      </tr>
      <tr>
        <td><?php echo get_kandidat(2);?></td>
        <td align="center"><?php echo round($vhmak3c,2)?></td>
        <td align="center"><?php echo round($vhmak6c,2)?></td>
        <td align="center" bgcolor="#CCCCCC"><?php echo round($vhmak9c,2)?></td>
        <td align="center"><?php echo round($ev3c,2)?></td>
      </tr>
      <tr>
        <td>&sum;</td>
        <td align="center"><?php echo round($thmaka_c,2)?></td>
        <td align="center"><?php echo round($thmakb_c,2)?></td>
        <td align="center"><?php echo round($thmakc_c,2)?></td>
        <td align="center"><?php echo round($evtotc,2)?></td>
      </tr>
    </table>
<div class="content_header">Matrik Alternatif Kedisiplinan</div>
    <table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td>&nbsp;</td>
        <td align="center"><?php echo get_kandidat(0);?></td>
        <td align="center"><?php echo get_kandidat(1);?></td>
        <td align="center"><?php echo get_kandidat(2);?></td>
      </tr>
      <tr>
        <td><?php echo get_kandidat(0);?></td>
        <td align="center" bgcolor="#CCCCCC">1</td>
        <td align="center">
        <input type="text" name="mak1d" id="mak1d" value="<?php echo $_POST['mak1d']?>" /></td>
        <td align="center">
        <input type="text" name="mak2d" id="mak2d" value="<?php echo $_POST['mak2d']?>" /></td>
      </tr>
      <tr>
        <td><?php echo get_kandidat(1);?></td>
        <td align="center"><?php echo round($hmak1d,2)?></td>
        <td align="center" bgcolor="#CCCCCC">1</td>
        <td align="center">
        <input type="text" name="mak3d" id="mak3d" value="<?php echo $_POST['mak3d']?>" /></td>
      </tr>
      <tr>
        <td><?php echo get_kandidat(2);?></td>
        <td align="center"><?php echo round($hmak2d,2)?></td>
        <td align="center"><?php echo round($hmak3d,2)?></td>
        <td align="center" bgcolor="#CCCCCC">1</td>
      </tr>
      <tr>
        <td>&sum;</td>
        <td align="center"><?php echo round($thmakad,2)?></td>
        <td align="center"><?php echo round($thmakbd,2)?></td>
        <td align="center"><?php echo round($thmakcd,2)?></td>
      </tr>
    </table>
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td>&nbsp;</td>
        <td align="center"><?php echo get_kandidat(0);?></td>
        <td align="center"><?php echo get_kandidat(1);?></td>
        <td align="center"><?php echo get_kandidat(2);?></td>
        <td align="center">Eigen Vektor</td>
      </tr>
      <tr>
        <td><?php echo get_kandidat(0);?></td>
        <td align="center" bgcolor="#CCCCCC"><?php echo round($vhmak1d,2)?></td>
        <td align="center"><?php echo round($vhmak4d,2)?></td>
        <td align="center"><?php echo round($vhmak7d,2)?></td>
        <td align="center"><?php echo round($ev1d,2)?></td>
      </tr>
      <tr>
        <td><?php echo get_kandidat(1);?></td>
        <td align="center"><?php echo round($vhmak2d,2)?></td>
        <td align="center" bgcolor="#CCCCCC"><?php echo round($vhmak5d,2)?></td>
        <td align="center"><?php echo round($vhmak8d,2)?></td>
        <td align="center"><?php echo round($ev2d,2)?></td>
      </tr>
      <tr>
        <td><?php echo get_kandidat(2);?></td>
        <td align="center"><?php echo round($vhmak3d,2)?></td>
        <td align="center"><?php echo round($vhmak6d,2)?></td>
        <td align="center" bgcolor="#CCCCCC"><?php echo round($vhmak9d,2)?></td>
        <td align="center"><?php echo round($ev3d,2)?></td>
      </tr>
      <tr>
        <td>&sum;</td>
        <td align="center"><?php echo round($thmaka_d,2)?></td>
        <td align="center"><?php echo round($thmakb_d,2)?></td>
        <td align="center"><?php echo round($thmakc_d,2)?></td>
        <td align="center"><?php echo round($evtotd,2)?></td>
      </tr>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input type="submit" name="submit" id="button" value="Submit" />
        <input type="reset" name="reset" id="reset" value="Reset" /></td>
      </tr>
    </table>
      
<div class="content_header">Analisis Sensitivitas AHP pada Bobot Kriteria</div>
<?php
$kriteria = array();
$id = get_uname_id();
$query_kriteria = mysql_query("SELECT * FROM `matrik` WHERE jenis='kriteria' AND user_id='$id'");
while( $row_kriteria = mysql_fetch_object($query_kriteria) ){
	$kriteria[]=$row_kriteria->matrik_value;
}
$i=0;
$query_alternatif = mysql_query("SELECT * FROM `matrik` WHERE jenis='alternatif' AND user_id='$id'");
$row_alternatif = mysql_fetch_object($query_alternatif);

$kriteria1 = $kriteria[0];
$kriteria2 = $kriteria[1];
$kriteria3 = $kriteria[2];
$kriteria4 = $kriteria[3];

$matrik0  = matrik_id(0);
$matrik1  = matrik_id(1);
$matrik2  = matrik_id(2);
$matrik3  = matrik_id(3);

$matrik4  = matrik_id(4);
$matrik5  = matrik_id(5);
$matrik6  = matrik_id(6);
$matrik7  = matrik_id(7);

$matrik8  = matrik_id(8);
$matrik9  = matrik_id(9);
$matrik10 = matrik_id(10);
$matrik11 = matrik_id(11);


$total_ranking0  = $kriteria1 *  $matrik0;
$total_ranking1  = $kriteria1 *  $matrik1;
$total_ranking2  = $kriteria3 *  $matrik2;

$total_ranking3  = $kriteria2 *  $matrik3;
$total_ranking4  = $kriteria2 *  $matrik4;
$total_ranking5  = $kriteria2 *  $matrik5;

$total_ranking6  = $kriteria3 *  $matrik6;
$total_ranking7  = $kriteria3 *  $matrik7;
$total_ranking8  = $kriteria3 *  $matrik8;

$total_ranking9  = $kriteria4 *  $matrik9;
$total_ranking10 = $kriteria4 *  $matrik10;
$total_ranking11 = $kriteria4 *  $matrik11;

$total_global0 = ($total_ranking0+$total_ranking3+$total_ranking6+$total_ranking9);
$total_global1 = ($total_ranking1+$total_ranking4+$total_ranking7+$total_ranking10);
$total_global2 = ($total_ranking2+$total_ranking5+$total_ranking8+$total_ranking11);

$total_globalx = ($total_global0+$total_global1+$total_global2);

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>Kriteria</td>
    <td align="center">Kepribadian</td>
    <td align="center">Komunikasi</td>
    <td align="center">Pengetahuan</td>
    <td align="center">Kedisiplinan</td>
  </tr>
  <tr>
    <td>Bobot</td>
    <td align="center"><?php echo round($kriteria1,2)?></td>
    <td align="center"><?php echo round($kriteria2,2)?></td>
    <td align="center"><?php echo round($kriteria3,2)?></td>
    <td align="center"><?php echo round($kriteria4,2)?></td>
  </tr>
  <tr>
    <td><?php echo get_kandidat(0);?></td>
    <td align="center"><?php echo round($matrik0,2)?></td>
    <td align="center"><?php echo round($matrik3,2)?></td>
    <td align="center"><?php echo round($matrik6,2)?></td>
    <td align="center"><?php echo round($matrik9,2)?></td>
  </tr>
  <tr>
    <td><?php echo get_kandidat(1);?></td>
    <td align="center"><?php echo round($matrik1,2)?></td>
    <td align="center"><?php echo round($matrik4,2)?></td>
    <td align="center"><?php echo round($matrik7,2)?></td>
    <td align="center"><?php echo round($matrik10,2)?></td>
  </tr>
  <tr>
    <td><?php echo get_kandidat(2);?></td>
    <td align="center"><?php echo round($matrik2,2)?></td>
    <td align="center"><?php echo round($matrik5,2)?></td>
    <td align="center"><?php echo round($matrik8,2)?></td>
    <td align="center"><?php echo round($matrik11,2)?></td>
  </tr>
</table><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="5">Total Ranking / Proritas Global</td>
    <td align="center">Prioriatas Global</td>
  </tr>
  <tr>
    <td><?php echo get_kandidat(0);?></td>
    <td align="center"><?php echo round($total_ranking0,2)?></td>
    <td align="center"><?php echo round($total_ranking3,2)?></td>
    <td align="center"><?php echo round($total_ranking6,2)?></td>
    <td align="center"><?php echo round($total_ranking9,2)?></td>
    <td align="center"><?php echo round($total_global0,2)?></td>
  </tr>
  <tr>
    <td><?php echo get_kandidat(1);?></td>
    <td align="center"><?php echo round($total_ranking1,2)?></td>
    <td align="center"><?php echo round($total_ranking4,2)?></td>
    <td align="center"><?php echo round($total_ranking7,2)?></td>
    <td align="center"><?php echo round($total_ranking10,2)?></td>
    <td align="center"><?php echo round($total_global1,2)?></td>
  </tr>
  <tr>
    <td><?php echo get_kandidat(2);?></td>
    <td align="center"><?php echo round($total_ranking2,2)?></td>
    <td align="center"><?php echo round($total_ranking5,2)?></td>
    <td align="center"><?php echo round($total_ranking8,2)?></td>
    <td align="center"><?php echo round($total_ranking11,2)?></td>
    <td align="center"><?php echo round($total_global2,2)?></td>
  </tr>
  <tr>
    <td colspan="5">&nbsp;</td>
    <td align="center"><?php echo round($total_globalx,2)?></td>
  </tr>
</table>

  </form>