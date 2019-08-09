<?php
/**
 * @file quick-link.php
 *
 */
//dilarang mengakses
defined('_iEXEC') or die();
global $iw,$db;
?>
<h3>Control Panel <span class="configure" ><a href="?admin&sys=options&go=quick-links" >Configure</a></span></h3>
<div class="dragbox-content" >
<?php
$QpA 	= get_option('qlinks');
$QpB 	= explode('#',$QpA);
$panel 	= array();
foreach($QpB as $key=>$val){
	$QpC 					= explode('::',$val);
	$val 					= uc_first($QpC[$key]);
	$panel[$key]['title'] 	= $QpC[0];
	$panel[$key]['desc'] 	= $QpC[0].' Manager';
	if($QpC[1]==1)$type = 'sys';
	elseif($QpC[1]==2)$type = 'apps';
	elseif($QpC[1]==3)$type = 'plg';
	else $type = 'unknow';
	if($type == 'plg') $panel[$key]['url'] = '?admin&sys=plugins&go=setting&id='.strto_case($QpC[2],'lower');
	else $panel[$key]['url'] = '?admin&'.$type.'='.strto_case($QpC[2],'lower');
}
?>
<div id="qpanel-content">
<table>
<?php
$kolom = 2;
foreach($panel as $k=>$v){
if($k % $kolom==0){
?>
<tr>
<?php
}
?>
<td align="center">
<a href="<?php _e($v['url']);?>">
<div class="panel-frame"><div class="panel-ico ico-<?php _e(strto_case($v['title'],'lower'));?>"></div>
<div class="panel-ico-text"><span><?php _e($v['title']);?></span><br><?php _e($v['desc']);?></div></div>
</a>
</td>
<?php
if(($k % $kolom) == ($kolom) or ($k + 2) == $jml){
?>
</tr>
<?php
}
}
?>
</table>
</div>

</div>

