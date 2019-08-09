<?php
/**
 * @file manage.php
 *
 */
//dilarang mengakses
defined('_iEXEC') or die();

require_once('init.php');

?>
<!--Manage Layout-->
<link href="iadmin/manage/plugins/style-plg.css" rel="stylesheet" media="screen" type="text/css" />
<div class="box-head dotted">Plugins Manager</div>
<div id="box-content">
<?php
global $iw,$db,$access,$session;
$go 	= filter_txt($_GET['go']);
$act	= filter_txt($_GET['act']);
$to		= filter_txt($_GET['to']);
$offset	= filter_int($_GET['offset']);
$pub	= filter_txt($_GET['pub']);
$path  	= filter_txt($_GET['path']);
$filed 	= filter_txt($_GET['file']);
//$ps 	= filter_txt($_GET['plugin_status']);
$id  	= filter_txt($_GET['id']);

$obj 	= country();
$widget = array(
'menu'		=> menu(),
'help_desk' => 'tool ini mempermudah anda memanage plugins yang anda pakai'
);

switch($go){
default:
if($act == 'pub' && !empty($act)){
	if ($pub == 'no') $stat =0;	
	if ($pub == 'yes') $stat =1;
	update_plugins($id,$stat);
}
if($act == 'del' && !empty($act)){
	if(!empty($id))
	del_plugins($id); 
}
if (isset($_POST['submit'])) {
	$plugin_name 	= $_POST['plugin_name'];
	$action 		= $_POST['action'];
	
	if(is_array($plugin_name))
	foreach($plugin_name as $key){
		if ($action == 'delete'):
			_e( alert('Are You sure delete this plugins?') );
			del_plugins($key); 
		else:
		if ($action == 'deactive') $stat =0;
		if ($action == 'active') $stat =1;	
		
		update_plugins($key,$stat);
		endif;
	}
}
?>
<form action="" method="post" enctype="multipart/form-data">
<div id="list-comment">
<div class="mash-div"></div>
<table id=table cellpadding="0" cellspacing="0" widtd="100%">
    <tr class="head" style="border-bottom:0;">
		<td style="text-align:left"><!--<input type="checkbox">--></td>
		<td style="text-align:left; width:25%">Plugin</td>
		<td style="text-align:left">Description</td>
	</tr>
<?php

$plugins 	= get_dir_plugins();
$warna		= '';
foreach($plugins as $key => $val){
$name 		= plugin_name($key);
$warna 		= empty ($warna) ? ' bgcolor="#f1f6fe"' : '';

//if(get_plugins($name)==$ps):
?>
	<tr <?php _e($warna)?>  class="isi">
	  <td style="text-align:left;border-bottom:0;"><input type="checkbox" name="plugin_name[]" value="<?php _e($name)?>" /><input type="hidden" name="plugin_path[]" value="<?php _e($key)?>" /></td>
	  <td style="text-align:left;border-bottom:0;"><strong><?php _e($val['Name'])?></strong></td>
	  <td style="text-align:left;border-bottom:0;"><p><?php _e($val['Description'])?></p></td>
    </tr>
	<tr <?php _e($warna)?>  class="isi">
	  <td></td>
	  <td style="text-align:left">
      <?php if(file_exists(Plg.$name.'/admin.php') && !empty($name)){?>
      <a href="?admin&sys=plugins&go=setting&id=<?php _e($name)?>" title="Setting this plugins">Setting</a> &bull;
      <?php }?>
      <?php 
	  if( get_plugins($name) == 1 ){
	  ?>
      <a href="?admin&sys=plugins&act=pub&pub=no&id=<?php _e($name)?>" title="Deactive this plugin">Deactive</a> 
      <?php }else{?>
      <a href="?admin&sys=plugins&act=pub&pub=yes&id=<?php _e($name)?>" title="Activate this plugin">Activate</a> 
      <?php }?>
      &bull;
      <a href="?admin&sys=plugins&go=edit&id=<?php _e($name)?>" title="Open this file in tde Plugin Editor">Edit</a> &bull;
      <a href="?admin&sys=plugins&act=del&id=<?php _e($name)?>" title="Delete this plugin" onclick="return confirm('Are You sure delete this plugins?')">Delete</a>
      </td>
	  <td class="desc">Version <?php _e($val['Version'])?> | By <a target="_blank" href="<?php _e($val['AuthorURI'])?>" title="Visit autdor homepage"><?php _e($val['Author'])?></a> | <a target="_blank" href="<?php _e($val['PluginURI'])?>" title="Visit plugin site">Visit plugin site</a></td>
    </tr>
<?php
//endif;
}
?>
    <tr class="head">
	  <td style="text-align:left;border-top:0;"><!--<input type="checkbox">--></td>
	  <td style="text-align:left;border-top:0;">Plugin</td>
	  <td style="text-align:left;border-top:0;">Description</td>
    </tr>
</table>
</div>
<div class=num style="height:24px;">
<div class="left">
<div style="margin-top:-2px; margin-right:2px; float:left">
<select name="action">
<option value="active">Active</option>
<option value="deactive">Deactive</option>
<option value="delete">Delete</option>
</select>
</div>
<button name="submit" class="primary"><span class="icon pen"></span>Go</button> or <button name="Reset"><span class="icon loop"></span>Reset</button>
</div>
<!--
<div class="right">Show :
<a href="?admin&sys=plugins&plugin_status=all" class="button">All</a>
<a href="?admin&sys=plugins&plugin_status=active" class="button">Active</a>
<a href="?admin&sys=plugins&plugin_status=inactive" class="button">Inactive</a>
</div>
-->
</div>
</form>

<?php
break;
case'edit':
if(!empty($id))

$path_dir = Plg.$id;
if( file_exists( $path_dir.'/'.$id.'.php' ) ):

	if(isset($filed) && !empty($filed)){
		 $edit_file = Plg.$filed;
	}else{
		 $edit_file = $path_dir.'/'.$id.'.php';
	}
	
$widget = array(
'menu'		=> menu(),
'gadget'	=> array(gadget($id)),
'help_desk' => 'tool ini mempermudah anda memanage plugins yang anda pakai'
);
else: 
	$edit_file = $path_dir.'.php';
endif;
if (isset($_POST['submit'])) {
	$file = $_POST['file'];
	save_to_file($file);
}
?>
<div class=num style="text-align:left"><?php _e( get_file_name($edit_file) )?></div>
<form action="" method="post" enctype="multipart/form-data" name="form1">
<input type="hidden" name="file" value="<?php _e($edit_file)?>">
<textarea id="textcode" name="content">
<?php _e(htmlspecialchars(file_get_contents( $edit_file )))?>
</textarea>
<div class=num style="text-align:left;">
<button name="submit" class="primary"><span class="icon pen"></span>Save & Update</button> or <button name="Reset"><span class="icon loop"></span>Reset</button>
</div>
</form>
<?php
break;

case'setting':
if(file_exists(Plg.$id.'/admin.php') && !empty($id)){
	include Plg.$id.'/admin.php';
}
else
{
	redirect('?admin&sys=plugins');
}
break;
}
?>
</div>


