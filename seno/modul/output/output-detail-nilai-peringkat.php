<div class="content_header">Prioritas Global</div>
<?php
$kriteria = array();
$id = get_uname_id();
$query_kriteria = mysql_query("SELECT * FROM `matrik` WHERE jenis='kriteria' AND user_id='$id'");
while( $row_kriteria = mysql_fetch_object($query_kriteria) ){
	$kriteria[]=$row_kriteria->matrik_value;
}

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

$total_rankingx  = (($total_ranking0 + $total_ranking1 + $total_ranking2 + $total_ranking3) /4);

$total_ranking3  = $kriteria2 *  $matrik3;
$total_ranking4  = $kriteria2 *  $matrik4;
$total_ranking5  = $kriteria2 *  $matrik5;

$total_ranking6  = $kriteria3 *  $matrik6;
$total_ranking7  = $kriteria3 *  $matrik7;
$total_ranking8  = $kriteria3 *  $matrik8;

$total_ranking9  = $kriteria4 *  $matrik9;
$total_ranking10 = $kriteria4 *  $matrik10;
$total_ranking11 = $kriteria4 *  $matrik11;

$total_global0 = ($total_ranking0+$total_ranking3+$total_ranking6+$total_ranking9)/4;
$total_global1 = ($total_ranking1+$total_ranking4+$total_ranking7+$total_ranking10)/4;
$total_global2 = ($total_ranking2+$total_ranking5+$total_ranking8+$total_ranking11)/4;
?>
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr>
      <td align="center">Kriteria</td>
      <td align="center">Kepribadian</td>
      <td align="center">Komunikasi</td>
      <td align="center">Pengetahuan</td>
      <td align="center">Kedisiplinan</td>
      <td align="center">Total Bobot</td>
    </tr>
    <tr>
      <td align="center">Bobot Kriteria</td>
      <td align="center"><?php echo round($kriteria1,2)?></td>
      <td align="center"><?php echo round($kriteria2,2)?></td>
      <td align="center"><?php echo round($kriteria3,2)?></td>
      <td align="center"><?php echo round($kriteria4,2)?></td>
      <td align="center"><?php echo round($total_rankingx,2)?></td>
    </tr>
    <tr>
      <td align="center"><?php echo get_kandidat(0);?></td>
      <td align="center"><?php echo round($total_ranking0,2)?></td>
      <td align="center"><?php echo round($total_ranking3,2)?></td>
      <td align="center"><?php echo round($total_ranking6,2)?></td>
      <td align="center"><?php echo round($total_ranking9,2)?></td>
      <td align="center"><?php echo round($total_global0,2)?></td>
    </tr>
    <tr>
      <td align="center"><?php echo get_kandidat(1);?></td>
      <td align="center"><?php echo round($total_ranking1,2)?></td>
      <td align="center"><?php echo round($total_ranking4,2)?></td>
      <td align="center"><?php echo round($total_ranking7,2)?></td>
      <td align="center"><?php echo round($total_ranking10,2)?></td>
      <td align="center"><?php echo round($total_global1,2)?></td>
    </tr>
    <tr>
      <td align="center"><?php echo get_kandidat(2);?></td>
      <td align="center"><?php echo round($total_ranking2,2)?></td>
      <td align="center"><?php echo round($total_ranking5,2)?></td>
      <td align="center"><?php echo round($total_ranking8,2)?></td>
      <td align="center"><?php echo round($total_ranking11,2)?></td>
      <td align="center"><?php echo round($total_global2,2)?></td>
    </tr>
  </table>
  <br />
  <div align="center">
    <form id="form1" name="form1" method="post" action="">
      <input type="submit" name="print" id="button" value="Print" />
    </form>
  </div>
</div>
