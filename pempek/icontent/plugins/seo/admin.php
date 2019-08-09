<?php
/**
 * @file: admin.php
 * @type: plugin-seo
 */ 
//not direct access
defined('_iEXEC') or die();

if(!function_exists('set_permalinks')){
	function set_permalinks($id){	
		
		$permalink 	= get_option('permalinks');
		$a 			= explode('#',$permalink);
		foreach($a as $b){
		$c 			= explode('::',$b);	
		
		if($c[0]!=5) $pagar = '#';
		else $pagar = '';
		
		if($c[0]!=$id){
			$data.= $c[0].'::'.$c[1].'::'.$c[2].'::'.'0'.$pagar;
		}else{
			$data.= $c[0].'::'.$c[1].'::'.$c[2].'::'.'1'.$pagar;
		}}	
		if(set_option('permalinks',$data)) _e('<div id="success"><strong>SUCCESS</strong>: Opsi Permalinks berhasil di perbaharui</div>');
	}
}

if(isset($_POST['submit'])){
	$seo_id = esc_sql($_POST['seo_id']);
	
	set_permalinks($seo_id);
}
?>
<form action="" method="post">
<table id=table cellpadding="0" cellspacing="0" width="100%">
<tr class="head">
<td width="20%" style="text-align:left"><strong>Title</strong></td>
<td width="69%" style="text-align:left"><strong>Link</strong></td>
<td width="11%" align="center"><strong>Option</strong></td>
<td width="11%" align="center"><strong>Status</strong></td>
</tr>
<?php
$permalink = get_option('permalinks');
$warna 	= '';
$a 		= explode('#',$permalink);
foreach($a as $b){
$c 		= explode('::',$b);
$warna 	= empty ($warna) ? ' bgcolor="#f1f6fe"' : '';
$status = ($c[3] == 1) ? '<span class="enable" title="Enable"></span>' : '<span class="disable" title="Disable"></span>';
$checked='';

if($c[3]==1) $checked='checked="checked"';
?>
<tr <?php _e($warna)?> class="isi">
<td align="left"><?php _e($c[1])?></td>
<td align="left"><?php _e($c[2])?></td>
<td align="center"><label><input type="radio" name="seo_id" value="<?php _e($c[0])?>" <?php _e($checked)?>></label></td>
<td align="left"><?php _e($status)?></td>
</tr>
<?php
}
?>
</table><div class=num style="text-align:left;">
<button name="submit" class="primary"><span class="icon pen"></span>Save & Update</button> or 
<button name="Reset"><span class="icon loop"></span>Reset</button></div></form>
