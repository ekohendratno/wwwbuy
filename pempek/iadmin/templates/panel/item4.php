<?php
/**
 * @file rec-reg.php
 *
 */
//dilarang mengakses
defined('_iEXEC') or die();
global $iw,$db;
$obj = country();
?>
			<h3>Statistik</h3>
			<div class="dragbox-content" >

<!--start-tabs-->
<div class="tabs-content">
<!--start-->
<ul class="stat">
<li><a href="#stat-os">OS</a></li>
<li><a href="#stat-day">Hari</a></li>
<li><a href="#stat-month">Bulan</a></li>
<li><a href="#stat-clock">Clock</a></li>
<li><a href="#stat-browser">Browser</a></li>
<li><a href="#stat-country">Country</a></li>
</ul>
<?php
class statistik
{
	function progress($option){
	global $iw,$db;
	$limit		= 10;
	$a			= new paging_admin();
	$query		= $db->select('stat_browse',array('title'=>$option));
	$show		= $db->fetch_array($query);
	$option 	= explode("#", $show["option"]);
	$hits	 	= explode("#", $show["hits"]);
	$totopt 	= count($option);
	$tothits 	= 0;
	foreach($hits as $vhit){
		$tothits = $tothits + $vhit;
	}
	if($tothits == 0) $tothits = 1;
	$progress=array(
	'opt'		=>$option,
	'hit'		=>$hits,
	'totopt'	=>$totopt,
	'tothit'	=>$tothits,
	'percent'	=>$persentase,
	'option'	=>$option
	);
	return $progress;
	}
	function select_color($persentase){
		$color='';
	if($persentase < 45){
		$color='orange';
	}elseif($persentase < 70){
		$color='green';
	}else{
		$color='blue';
	}
	return $color;
	}
}
$stat 		= new statistik;
?>
<div id="stat-os" class="tab_stat">
<div class="progress">
<?php
$progress 	= $stat->progress('os');
for($i=0;$i<$progress['totopt'];$i++){
?>
<div class="jpaginate1">
<?php
$persentase = round($progress['hit'][$i] / $progress['tothit'] * 100, 2);
?>
<div class="progress-container">
<span class="no">
<?php 
$no = $i+1;
_e($no);
?>
</span>
<span class="name"><?php _e($progress['opt'][$i]);?></span>
<span class="persent"><?php _e(numformat($progress['hit'][$i]));?></span>
<div style="width: <?php _e($persentase);?>%" class="<?php _e( $stat->select_color($persentase) );?>"></div>
</div>
</div>
<?php
}
?>
<div class="total">
<span>Total : <?php _e(numformat($progress['tothit']));?> Visitor</span>
<span class="orange fw">low</span>
<span class="green fw">medium</span>
<span class="blue fw">height</span>
</div>
</div>
<!--end-->
</div>
<div id="stat-day" class="tab_stat">
<div class="progress">
<?php
$progress 	= $stat->progress('day');
for($i=0;$i<$progress['totopt'];$i++){
?>
<div class="jpaginate1">
<?php
$persentase = round($progress['hit'][$i] / $progress['tothit'] * 100, 2);
?>
<div class="progress-container">
<span class="no">
<?php 
$no = $i+1;
_e($no);
?>
</span>
<span class="name"><?php _e($progress['opt'][$i]);?></span>
<span class="persent"><?php _e(numformat($progress['hit'][$i]));?></span>
<div style="width: <?php _e($persentase);?>%" class="<?php _e( $stat->select_color($persentase) );?>"></div>
</div>
</div>
<?php
}
?>
<div class="total">
<span>Total : <?php _e(numformat($progress['tothit']));?> Visitor</span>
<span class="orange fw">low</span>
<span class="green fw">medium</span>
<span class="blue fw">height</span>
</div>
</div>
<!--end-->
</div>
<div id="stat-month" class="tab_stat">
<div class="progress">
<?php
$progress 	= $stat->progress('month');
for($i=0;$i<$progress['totopt'];$i++){
?>
<div class="jpaginate1">
<?php
$persentase = round($progress['hit'][$i] / $progress['tothit'] * 100, 2);
?>
<div class="progress-container">
<span class="no">
<?php 
$no = $i+1;
_e($no);
?>
</span>
<span class="name"><?php _e($progress['opt'][$i]);?></span>
<span class="persent"><?php _e(numformat($progress['hit'][$i]));?></span>
<div style="width: <?php _e($persentase);?>%" class="<?php _e( $stat->select_color($persentase) );?>"></div>
</div>
</div>
<?php
}
?>
<div class="total">
<span>Total : <?php _e(numformat($progress['tothit']));?> Visitor</span>
<span class="orange fw">low</span>
<span class="green fw">medium</span>
<span class="blue fw">height</span>
</div>
</div>
<!--end-->
</div>
<div id="stat-clock" class="tab_stat">
<div class="progress">
<?php
$progress 	= $stat->progress('clock');
for($i=0;$i<$progress['totopt'];$i++){
?>
<div class="jpaginate1">
<?php
$persentase = round($progress['hit'][$i] / $progress['tothit'] * 100, 2);
?>
<div class="progress-container">
<span class="no">
<?php 
$no = $i+1;
_e($no);
?>
</span>
<span class="name"><?php _e($progress['opt'][$i]);?></span>
<span class="persent"><?php _e(numformat($progress['hit'][$i]));?></span>
<div style="width: <?php _e($persentase);?>%" class="<?php _e( $stat->select_color($persentase) );?>"></div>
</div>
</div>
<?php
}
?>
<div class="total">
<span>Total : <?php _e(numformat($progress['tothit']));?> Visitor</span>
<span class="orange fw">low</span>
<span class="green fw">medium</span>
<span class="blue fw">height</span>
</div>
</div>
<!--end-->
</div>
<div id="stat-browser" class="tab_stat">
<!--start-->
<div class="progress">
<?php
$progress 	= $stat->progress('browser');
for($i=0;$i<$progress['totopt'];$i++){
?>
<div class="jpaginate2">
<?php
$persentase = round($progress['hit'][$i] / $progress['tothit'] * 100, 2);
?>
<div class="progress-container">
<span class="no">
<?php 
$no = $i+1;
_e($no);
?>
</span>
<span class="name"><?php _e($progress['opt'][$i]);?></span>
<span class="persent"><?php _e(numformat($progress['hit'][$i]));?></span>
<div style="width: <?php _e($persentase);?>%" class="<?php _e( $stat->select_color($persentase) );?>"></div>
</div>
</div>
<?php
}
?>
<div class="total">
<span>Total : <?php _e(numformat($progress['tothit']));?> Visitor</span>
<span class="orange fw">low</span>
<span class="green fw">medium</span>
<span class="blue fw">height</span>
</div>
</div>
</div>
<div id="stat-country" class="tab_stat">
<!--start-->
<div class="progress">
<?php
$progress 	= $stat->progress('country');
for($i=0;$i<$progress['totopt']-1;$i++){
?>
<div class="jpaginate2">
<?php
$persentase = round($progress['hit'][$i] / $progress['tothit'] * 100, 2);
?>
<div class="progress-container">
<span class="no">
<?php 
$no = $i+1;
_e($no);
?>
</span>
<span class="name"><?php _e($obj->CountryName($progress['opt'][$i]));?></span>
<span class="persent"><?php _e(numformat($progress['hit'][$i]));?></span>
<div style="width: <?php _e($persentase);?>%" class="<?php _e( $stat->select_color($persentase) );?>"></div>
</div>
</div>
<?php
}
?>
<div class="total">
<span>Total : <?php _e(numformat($progress['tothit']));?> Visitor</span>
<span class="orange fw">low</span>
<span class="green fw">medium</span>
<span class="blue fw">height</span>
</div>
</div>
</div>

</div>
<!--end-tabs-->

            </div>


