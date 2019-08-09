<div class="content_header">Matrik Kriteria</div>
<?php 
if( isset($_POST['submit']) ){
	$mk1 = $_POST['mk1'];
	$mk2 = $_POST['mk2'];
	$mk3 = $_POST['mk3'];
	$mk4 = $_POST['mk4'];
	$mk5 = $_POST['mk5'];
	$mk6 = $_POST['mk6'];	
	//==================================
	$hmk1 = (1/$mk1);
	$hmk2 = (1/$mk2);
	$hmk3 = (1/$mk3);
	$hmk4 = (1/$mk4);
	$hmk5 = (1/$mk5);
	$hmk6 = (1/$mk6);	
	//==================================
	$thmka = (1+$hmk1+$hmk2+$hmk3);
	$thmkb = (1+$mk1+$hmk4+$hmk5);
	$thmkc = (1+$mk2+$mk4+$hmk6);
	$thmkd = (1+$mk3+$mk5+$mk6);
	//==================================
	$vhmk1 	= (1/$thmka);
	$vhmk2 	= ($hmk1/$thmka);
	$vhmk3 	= ($hmk2/$thmka);
	$vhmk4 	= ($hmk3/$thmka);	
	
	$vhmk5 	= ($mk1/$thmkb);
	$vhmk6 	= (1/$thmkb);
	$vhmk7 	= ($hmk4/$thmkb);
	$vhmk8 	= ($hmk5/$thmkb);
		
	$vhmk9 	= ($mk2/$thmkc);
	$vhmk10 = ($mk4/$thmkc);
	$vhmk11 = (1/$thmkc);
	$vhmk12 = ($hmk6/$thmkc);
		
	$vhmk13 = ($mk3/$thmkd);
	$vhmk14 = ($mk5/$thmkd);
	$vhmk15 = ($mk6/$thmkd);
	$vhmk16 = (1/$thmkd);
	
	$ev1 = (($vhmk1+$vhmk5+$vhmk9+$vhmk13)/4);
	$ev2 = (($vhmk2+$vhmk6+$vhmk10+$vhmk14)/4);
	$ev3 = (($vhmk3+$vhmk7+$vhmk11+$vhmk15)/4);
	$ev4 = (($vhmk4+$vhmk8+$vhmk12+$vhmk16)/4);
	
	$max1 = ($ev1*$thmka);
	$max2 = ($ev2*$thmkb);
	$max3 = ($ev3*$thmkc);
	$max4 = ($ev4*$thmkd);
	
	$tev = ($ev1+$ev2+$ev3+$ev4);
	$tmax = ($max1+$max2+$max3+$max4);
	//IK => (totB-4)/3 RK =>(IK/0.9)
	$ik = (($tmax-4)/3);
	$rk = ($ik/0.9);
	
	$ev = array($ev1,$ev2,$ev3,$ev4);
	$run_update = $run_insert = '';
	
	$user_id = get_uname_id();
	
	$select_pa = mysql_query("SELECT * FROM `matrik`  WHERE  `jenis` =  'kriteria' AND  `user_id` =  '$user_id'");
	$num_pa = mysql_num_rows($select_pa);
	
	if( $num_pa > 0 ){	
		$i=0;
		while( $row_pa = mysql_fetch_object($select_pa) ){
		$evx = $ev[$i];
		$run_update.= mysql_query("UPDATE  `matrik` SET  `matrik_value` =  '$evx' WHERE  `id_matrik` =  '$row_pa->id_matrik' AND `jenis` =  'kriteria' AND `user_id` = '$user_id'");
		$i++;
		}
	}else{
		for($i=0; $i<=3; $i++){
		$evx = $ev[$i];
		$run_insert.= mysql_query("INSERT INTO `matrik` (`id_matrik`, `user_id`, `matrik_value`,`jenis`) VALUES ('$i','$user_id', '$evx','kriteria')");
		}
	}
	
	if( $run_update ) echo "<div class=\"sukses\">Berhasil di perbaharui</div><br>";
	elseif( $run_insert ) echo "<div class=\"sukses\">Berhasil di tambahkan</div><br>";
	else echo "<div class=\"error\">Gagal disimpan</div><br>";
	
}
?>
<form action="" method="post">
<table width="100%" cellspacing="0" cellpadding="0">
    <tr>
      <td>&nbsp;</td>
      <td align="center">Kepribadian</td>
      <td align="center">Komunikasi</td>
      <td align="center">Pengetahuan</td>
      <td align="center">Kedisiplinan</td>
      </tr>
    <tr>
      <td>Kepribadian</td>
      <td align="center" bgcolor="#CCCCCC">1</td>
      <td align="center"><input type="text" name="mk1" id="mk1" value="<?php echo $_POST['mk1']?>"></td>
      <td align="center"><input type="text" name="mk2" id="mk2" value="<?php echo $_POST['mk2']?>"></td>
      <td align="center"><input type="text" name="mk3" id="mk3" value="<?php echo $_POST['mk3']?>"></td>
      </tr>
    <tr>
      <td>Komunikasi</td>
      <td align="center"><?php echo round($hmk1,2)?></td>
      <td align="center" bgcolor="#CCCCCC">1</td>
      <td align="center"><input type="text" name="mk4" id="mk4" value="<?php echo $_POST['mk4']?>"></td>
      <td align="center"><input type="text" name="mk5" id="mk5" value="<?php echo $_POST['mk5']?>"></td>
      </tr>
    <tr>
      <td>Pengetahuan</td>
      <td align="center"><?php echo round($hmk2,2)?></td>
      <td align="center"><?php echo round($hmk4,2)?></td>
      <td align="center" bgcolor="#CCCCCC">1</td>
      <td align="center"><input type="text" name="mk6" id="mk6" value="<?php echo $_POST['mk6']?>"></td>
      </tr>
    <tr>
      <td>Kedisiplinan</td>
      <td align="center"><?php echo round($hmk3,2)?></td>
      <td align="center"><?php echo round($hmk5,2)?></td>
      <td align="center"><?php echo round($hmk6,2)?></td>
      <td align="center" bgcolor="#CCCCCC">1</td>
      </tr>
    <tr>
      <td>Jumlah</td>
      <td align="center"><?php echo round($thmka,2)?></td><!-- tmk1 -->
      <td align="center"><?php echo round($thmkb,2)?></td><!-- tmk2 -->
      <td align="center"><?php echo round($thmkc,2)?></td><!-- tmk3 -->
      <td align="center"><?php echo round($thmkd,2)?></td><!-- tmk4 -->
      </tr>
    <tr>
      <td colspan="5"><input type="submit" name="submit" id="submit" value="Submit" />
        <input type="reset" name="reset" id="reset" value="Reset" /></td>
      </tr>
  </table>
</form>
<?php if( isset($_POST['submit']) ){?>
<table width="100%" cellspacing="0" cellpadding="0">
    <tr>
      <td>&nbsp;</td>
      <td align="center">Kepribadian</td>
      <td align="center">Komunikasi</td>
      <td align="center">Pengetahuan</td>
      <td align="center">Kedisiplinan</td>
      <td align="center">Eigen Vector</td>
      <td align="center">^Maks</td>
    </tr>
    <tr>
      <td>Kepribadian</td>
      <td align="center"><?php echo round($vhmk1,2)?></td>
      <td align="center"><?php echo round($vhmk5,2)?></td>
      <td align="center"><?php echo round($vhmk9,2)?></td>
      <td align="center"><?php echo round($vhmk13,2)?></td>
      <td align="center"><?php echo round($ev1,2)?></td>
      <td align="center"><?php echo round($max1,2)?></td>
    </tr>
    <tr>
      <td>Komunikasi</td>
      <td align="center"><?php echo round($vhmk2,2)?></td>
      <td align="center"><?php echo round($vhmk6,2)?></td>
      <td align="center"><?php echo round($vhmk10,2)?></td>
      <td align="center"><?php echo round($vhmk14,2)?></td>
      <td align="center"><?php echo round($ev2,2)?></td> <!-- abcd/4 -->
      <td align="center"><?php echo round($max2,2)?></td> <!-- (abcd/4)*tmk2 -->
    </tr>
    <tr>
      <td>Pengetahuan</td>
      <td align="center"><?php echo round($vhmk3,2)?></td>
      <td align="center"><?php echo round($vhmk7,2)?></td>
      <td align="center"><?php echo round($vhmk11,2)?></td>
      <td align="center"><?php echo round($vhmk15,2)?></td>
      <td align="center"><?php echo round($ev3,2)?></td>
      <td align="center"><?php echo round($max3,2)?></td>
    </tr>
    <tr>
      <td>Kedisiplinan</td>
      <td align="center"><?php echo round($vhmk4,2)?></td>
      <td align="center"><?php echo round($vhmk8,2)?></td>
      <td align="center"><?php echo round($vhmk12,2)?></td>
      <td align="center"><?php echo round($vhmk16,2)?></td>
      <td align="center"><?php echo round($ev4,2)?></td>
      <td align="center"><?php echo round($max4,2)?></td>
    </tr>
    <tr>
      <td colspan="5">&nbsp;</td>
      <td align="center"><?php echo round($tev,2)?></td>
      <td align="center"><?php echo round($tmax,2)?></td>
    </tr>
  </table>
  <br />
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td width="23%">Index Konsistensi</td>
    <td width="1%"><strong>:</strong></td>
    <td width="76%"><?php echo round($ik,2)?></td>
    </tr>
  <tr>
    <td>Rasio Konsistensi</td>
    <td><strong>:</strong></td>
    <td><?php echo round($rk,2)?></td>
    </tr>
  <tr>
    <td colspan="3" align="center">
    <?php
	if( $rk > 0.10 ) echo "<div class=\"kons_no\">Tidak Konsisten</div>";
	else echo "<div class=\"kons_yes\">Konsisten</div>";
	?>    
    </td>
    </tr>
</table>
<?php }?>