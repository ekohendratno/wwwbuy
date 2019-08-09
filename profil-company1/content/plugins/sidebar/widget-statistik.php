<?php
global $db;
$q = $db->select('stat_count', array('id'=>1) );
$visitor = $hits = 0;
while ( $data = $db->fetch_array($q) ) {
	$visitor+= $data[2];
	$hits+= $data[3];
}		

$now = $db->num( $db->select("stat_online") );
$day = $db->num( $db->select("stat_onlineday") );
$month = $db->num( $db->select("stat_onlinemonth") );
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
    <td width="10%"><img src="<?php echo plugins_url();?>/sidebar/images/community.png" alt="" border="0"></td>
    <td width="15%">Visitor</td>
    <td width="1%">:</td>
    <td width="74%"><center><b><?php echo $visitor;?></b></center></td>
  </tr>
  <tr>
    <td><img src="<?php echo plugins_url();?>/sidebar/images/chart.png" alt="" border="0"></td>
    <td>Hits</td>
    <td>:</td>
    <td><center><b><?php echo $hits;?></b></center></td>
  </tr>
  <tr>
    <td><img src="<?php echo plugins_url();?>/sidebar/images/users.png" alt="" border="0"></td>
    <td>Month</td>
    <td>:</td>
    <td><center><b><b><?php echo $month;?></b></b></center></td>
  </tr>
  <tr>
    <td><img src="<?php echo plugins_url();?>/sidebar/images/user.png" alt="" border="0"></td>
    <td>Day</td>
    <td>:</td>
    <td><center><b><b><?php echo $day;?></b></b></center></td>
  </tr>
  <tr>
    <td><img src="<?php echo plugins_url();?>/sidebar/images/user_add.png" alt="" border="0"></td>
    <td>Online</td>
    <td>:</td>
    <td><center><b><b><?php echo $now;?></b></b></center></td>
	
</tr></tbody></table>