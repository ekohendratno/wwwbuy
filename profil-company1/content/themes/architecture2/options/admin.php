<?php 
/**
 * @fileName: admin.php
 * @dir: themes/iNet/options/
 */
if(!defined('_iEXEC')) exit;

global $theme_name;

ob_start();

switch( $_GET['to'] ){
default:

if( isset( $_POST['submit'] ) ) {
	
	$data[logo] = filter_txt($_POST['logo']);
	$data[ads] = $_POST['ads'];
	$data[limit_slide] = filter_int($_POST['limit_slide']);
	
	if ( ! is_array( $data ) )
		return false;
		
	$data = json_encode( $data );
	if( !checked_option( 'architecture2_options' ) ) add_option( 'architecture2_options', $data );
	else set_option( 'architecture2_options', $data );
	
	add_activity('theme',"Mengubah pengaturan inet_options", 'appearance');
	redirect('?admin&sys=appearance&go=custom-theme');
}
?>
<div class="padding">
<table width="100%" border="0" cellpadding="4" cellspacing="2">
  <tr>
    <td width="17%" align="left" valign="top">Logo View</td>
    <td width="1%" align="left" valign="top"><strong>:</strong></td>
    <td width="82%" align="left" valign="top"><img src="<?php echo architecture2_theme_option('logo');?>" style="max-width:400px; max-height:300px;"></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">Logo URL</td>
    <td align="left" valign="top"><strong>:</strong></td>
    <td align="left" valign="top"><textarea name="logo" style="width:95%;"><?php echo architecture2_theme_option('logo');?></textarea></td>
  </tr>
<?php
$ads = architecture2_theme_option('ads');
foreach($ads as $ads_k => $ads_v){
?>
  <tr>
    <td align="left" valign="top">Ads URL <?php echo $ads_k;?></td>
    <td align="left" valign="top"><strong>:</strong></td>
    <td align="left" valign="top"><textarea name="ads[<?php echo $ads_k;?>]" style="width:95%;"><?php echo $ads_v;?></textarea></td>
  </tr>
  <tr>
    <td align="left" valign="top">Ads View <?php echo $ads_k;?></td>
    <td align="left" valign="top"><strong>:</strong></td>
    <td align="left" valign="top"><img src="<?php echo $ads_v;?>"></td>
  </tr>
<?php
}
?>
  <tr>
    <td align="left" valign="top">Limit Slide</td>
    <td align="left" valign="top"><strong>:</strong></td>
    <td align="left" valign="top"><input type="text" name="limit_slide" style="width:15%;" value="<?php echo architecture2_theme_option('limit_slide');?>"/></td>
  </tr>
</table>
</div>
<?php
break;
}

$content = ob_get_contents();
ob_end_clean();

$header_menu = '<div class="header_menu_top">';
$header_menu.= '<input type="submit" name="submit" class="button on blue" value="Save &amp; Update">';
$header_menu.= '</div>';
$header_menu.= '<div class="header_menu_top2">';
$header_menu.= '<a href="?admin&sys=appearance&go=custom-theme" class="button l">Home</a>';
$header_menu.= '<a href="?admin&sys=appearance" class="button r"><span class="icon_head back">&laquo; Back</span></a>';
$header_menu.= '</div>';

add_templates_manage( $content, $theme_name[1] . ' Theme Options', $header_menu, null,'action="" method="post"');