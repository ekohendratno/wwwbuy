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

<div class="box-head dotted">Menu</div>
<div id="box-content">
<?php
global $iw,$db;
$go 	= filter_txt($_GET['go']);
$act	= filter_txt($_GET['act']);
$to 	= filter_txt($_GET['to']);
$op 	= filter_txt($_GET['op']);
$pub 	= filter_txt($_GET['pub']);
$id 	= filter_int($_GET['id']);

$widget = array(
'menu'		=> menu(),
'help_desk' => 'Dengan tool ini anda bisa menggunakannya untuk menambahkan menu pada kolom sidebar web'
);
switch($go){
default:
if(isset($_POST['submit'])){
	$ida 	= $_POST['ida'];
	$ordera = $_POST['ordera'];
	$idb 	= $_POST['idb'];
	$orderb	= $_POST['orderb'];
	$orderby= $_POST['orderby'];
	$data   = compact('ida','ordera','idb','orderb','orderby');
	update_action_menus($data);
}	
if($act == 'pub' && !empty($act)){
if($to == 'sub'){
	if ($pub == 'no')  $stat =0;	
	if ($pub == 'yes') $stat =1;
	update_sub_menu( array('status'=>$stat),$id );
}elseif($to == 'posisi'){
	if ($pub == 'left') $posisi =0;	
	if ($pub == 'right') $posisi =1;
	if($op == 'sub') update_sub_menu(array('position'=>$posisi),$id); 
	else update_menu(array('position'=>$posisi),$id); 
}else{
	if ($pub == 'no')  $stat =0;	
	if ($pub == 'yes') $stat =1;
	update_menu( array('status'=>$stat),$id );
}}
if($act == 'del' && !empty($act)){
	if($to=='sub') del_sub_menu($id); 
	else del_menu($id);
}
$limit		= 10;
$a			= new paging_admin();
$q			= $a->query( "SELECT * FROM `".$iw->pre."menu` ORDER BY `ordering`", $limit);
?>
<form action="" method="post" enctype="multipart/form-data" name="form1">
<table id=table cellpadding="0" cellspacing="0" width="100%">
<tr class="head">
    <td style="text-align:left"><strong>Title</strong></td>
    <td align="center"><strong>Ordering</strong></td>
    <td align="center"><strong>Order By</strong></td>
    <td align="center"><strong>Status</strong></td>
    <td align="center"><strong>Position</strong></td>
    <td colspan="2" align="center"><strong>Action</strong></td>
  </tr>
<?php
$warna='';
while ($data = $db->fetch_array($q)) {
$by = $data['id'];
$warna = 'bgcolor="#e3e9f4"';

$status = ($data['status'] == 1) ? '<a  class="enable" title="Enable" href="?admin&sys=menus&act=pub&pub=no&id='.$by.'">Enable</a>' : '<a  class="disable" title="Disable" href="?admin&sys=menus&act=pub&pub=yes&id='.$by.'">Disable</a>';

$position = ($data['position'] == 1) ? '<a class="s-right" title="Right" href="?admin&sys=menus&act=pub&to=posisi&pub=left&id='.$by.'">Right</a>' : '<a class="s-left" title="Left" href="?admin&sys=menus&act=pub&to=posisi&pub=right&id='.$by.'">Left</a>';
?>
  <tr <?php _e($warna)?> class="isi">
    <td><b><?php _e($data['title'])?></b></td>
	<td width="33%">
    <div align="center">
    <input  style="width:20px;" type="text" name="ordera[]" value="<?php _e($data['ordering'])?>"/>
    <input type="hidden" name="ida[]" size="2" value="<?php _e($data['id'])?>"/>
    </div>
    </td>
    <td align="center"></td>
    <td align="center"><?php _e($status)?></td>
    <td align="center"><?php _e($position)?></td>
    <td width="10%">
    <div align="center">
<a href="?admin&sys=menus&go=edit&id=<?php _e($data['id'])?>" class="edit" title="edit">edit</a>
<a href="?admin&sys=menus&act=del&id=<?php _e($data['id'])?>" class="delete" title="delete" onclick="return confirm('Are You sure delete this menu?')">delete</a>
    </div>
    </td>
  </tr>
<?php
$q2 	= $db->select( "menu_sub",array('orderby'=>$by),'ORDER BY ordering');
$warna 	= '';
while ($subdata = $db->fetch_array($q2)){

$statussub = ($subdata['status'] == 1) ? '<a  class="enable" title="Enable" href="?admin&sys=menus&act=pub&to=sub&pub=no&id='.$subdata['id'].'">Enable</a>' : '<a  class="disable" title="Disable" href="?admin&sys=menus&act=pub&to=sub&pub=yes&id='.$subdata['id'].'">Disable</a>';

$position_sub = ($subdata['position'] == 1) ? '<a class="s-right" title="Right" href="?admin&sys=menus&act=pub&to=posisi&pub=left&op=sub&id='.$subdata['id'].'">Right</a>' : '<a class="s-left" title="Left" href="?admin&sys=menus&act=pub&to=posisi&pub=right&op=sub&id='.$subdata['id'].'">Left</a>';

$warna = empty ($warna) ? ' bgcolor="#f1f6fe"' : '';
?>
  <tr <?php _e($warna)?> class="isi">
    <td style="border-right:0;">- <?php _e($subdata['title'])?></td>
	<td width="33%"><div align="center">
    <input style="width:20px;" type="text" name="orderb[]" value="<?php _e($subdata['ordering'])?>"/>
    <input type="hidden" name="idb[]" size="2" value="<?php _e($subdata['id'])?>"/>
    </div></td>
    <td align="center">
<select name="orderby[]">
<?php
$qx = $db->select("menu");
while($datax = $db->fetch_array($qx)) {
$selected='';
if($datax['id'] == $subdata['orderby']) $selected ='selected="selected"'; 
_e('<option value="'.$datax['id'].'" '.$selected.'>'.uc_first($datax['title']).'</option>');
}
?></select>
	</td>
    <td align="center"><?php _e($statussub)?></td>
    <td align="center"><?php _e($position_sub)?></td>
    <td align="center">
    <div align="center">
<a href="?admin&sys=menus&go=edit&to=sub&id=<?php _e($subdata['id'])?>" class="edit" title="edit">edit</a>
<a href="?admin&sys=menus&act=del&to=sub&id=<?php _e($subdata['id'])?>" class="delete" title="delete" onclick="return confirm('Are You sure delete this sub menu?')">delete</a>
    </div>
	</td>
  </tr>
<?php
}
unset($numbers);
}
?>
</table>
<div class=num style="height:24px;">
<div class="left">
<button name="submit" class="primary"><span class="icon pen"></span>Save & Update</button> or <button name="Reset"><span class="icon loop"></span>Reset</button>
</div>
<div class="right">
<a href="?admin&amp;sys=menus&go=add" class="xleft button"><span class="icon plus"></span>Add Box Menu</a>
<a href="?admin&amp;sys=menus&go=add&to=sub" class="xright button"><span class="icon plus"></span>Add Menu</a>
</div>
</div>
<!--halaman navigasi-->
<div id="num">
<?php _e($a->pg('?admin&sys=menus'));?>
</div>
</form>
<?php
break;
case'userpanel':
if(isset($_POST['submit'])){
	$id 	= $_POST['id'];
	$order  = $_POST['order'];
	$data   = compact('id','order');
	update_order_menu_user($data);
}	
if($act == 'pub' && !empty($act)){
	if ($pub == 'no')  $stat =0;	
	if ($pub == 'yes') $stat =1;
	update_menu_user( array('status'=>$stat),$id );
}
if($act == 'del' && !empty($act)){
	del_menu_user($id);
}
$limit		= 10;
$a			= new paging_admin();
$q			= $a->query( "SELECT * FROM `".$iw->pre."menu_user` ORDER BY `ordering`", $limit);
?>
<form action="" method="post" enctype="multipart/form-data" name="form1">
<table id=table cellpadding="0" cellspacing="0" width="100%">
  <tr class="head">
    <td width="70%"><div style="text-align:left"><strong>Title</strong></div></td>
    <td width="12%" align="center"><strong>Ordering</strong></td>
    <td width="11%" align="center"><strong>Status</strong></td>
    <td colspan="2" align="center"><strong>Action</strong></td>
  </tr>
<?php
$warna='';
while ($data = $db->fetch_array($q)) {
$warna = empty ($warna) ? ' bgcolor="#f1f6fe"' : '';

$status = ($data['status'] == 1) ? '<a  class="enable" title="Enable" href="?admin&sys=menus&&go=userpanel&act=pub&pub=no&id='.$data['id'].'">Enable</a>' : '<a  class="disable" title="Disable" href="?admin&sys=menus&&go=userpanel&act=pub&pub=yes&id='.$data['id'].'">Disable</a>';
?>
  <tr <?php _e($warna)?> class="isi">
    <td style="border-right:0;"><?php _e($data['title'])?></td>
	<td width="5%"><div align="center"><input style="width:20px;" type="text" name="order[]" size="2" value="<?php _e($data['ordering'])?>"/><input type="hidden" name="id[]" size="2" value="<?php _e($data['id'])?>"/></div></td>
    <td align="center"><?php _e($status)?></td>
    <td align="center">
    <div align="center">
<a href="?admin&sys=menus&go=edit&to=userpanel&id=<?php _e($data['id'])?>" class="edit" title="edit">edit</a>
<a href="?admin&sys=menus&go=userpanel&act=del&id=<?php _e($data['id'])?>" class="delete" title="delete" onclick="return confirm('Are You sure delete this menu user panel?')">delete</a>
    </div>
    </td>
  </tr>
<?php
}
?></table>
<div class=num style="height:24px;">
<div class="left">
<button name="submit" class="primary"><span class="icon pen"></span>Save & Update</button> or <button name="Reset"><span class="icon loop"></span>Reset</button>
</div>
<div class="right">
<a href="?admin&amp;sys=menus&go=add&to=userpanel" class="button"><span class="plus icon"></span>Add</a>
</div>
</div>
<!--halaman navigasi-->
<div id="num">
<?php _e($a->pg('?admin&sys=menus&go=userpanel'));?>
</div>
</form>
<?php
break;
case'edit':
if($to=='userpanel'){
if(isset($_POST['submit'])){
	
	$title 			= 		esc_sql( $_POST['title']	);
	$url 			= 		esc_sql( $_POST['url']		);
	
	if( empty($title) ) _e('<div id="error"><strong>ERROR</strong>: Title is empty.</div>');
	if( empty($url) ) _e('<div id="error"><strong>ERROR</strong>: URL is empty.</div>');
	
	else update_menu_user( compact('title','url'), $id);
}
$q		= $db->select("menu_user",compact('id'));
$data   = $db->fetch_array($q);
?>
<form action="" method="post" enctype="multipart/form-data" name="form1">
  <table width="100%" border="0" cellspacing="1" cellpadding="0">
    <tr>
      <td width="5%">Title</td>
      <td width="1%"><strong>:</strong></td>
      <td width="94%"><input type="text" name="title" class="input" size="20" value="<?php _e($data['title'])?>"></td>
    </tr>
    <tr>
      <td>Url</td>
      <td><strong>:</strong></td>
      <td><textarea name="url" style="width:400px;"><?php _e($data['url'])?></textarea></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>
	  <button name="submit" class="primary"><span class="icon pen"></span>Save & Update</button> or <button name="Reset"><span class="icon loop"></span>Reset</button></td>
    </tr>
  </table>
</form>
<?php
}elseif($to=='sub'){

if(isset($_POST['submit'])){
	$title 			= 		esc_sql( $_POST['title']	);
	$url 			= 		esc_sql( $_POST['url']		);
	$orderby 		= (int)	esc_sql( $_POST['orderby']	);
	
	if( empty($title) ) _e('<div id="error"><strong>ERROR</strong>: Title is empty.</div>');	
	if( empty($url) ) _e('<div id="error"><strong>ERROR</strong>: URL is empty.</div>');
	
	$data = compact('title','url','orderby');
	update_sub_menu($data,$id);
}
$q		= $db->select("menu_sub",compact('id'));
$data   = $db->fetch_array($q);
?>
<form action="" method="post" enctype="multipart/form-data" name="form1">
  <table>
    <tr>
      <td width="5%">Title</td>
      <td width="1%"><strong>:</strong></td>
      <td width="94%"><input type="text" name="title"  value="<?php _e($data['title'])?>"></td>
    </tr>
    <tr>
      <td valign="top">Url</td>
      <td valign="top"><strong>:</strong></td>
      <td><textarea name="url" style="width:400px;"><?php _e($data['url'])?></textarea></td>
    </tr>
    <tr>
      <td>Sub</td>
      <td><strong>:</strong></td>
      <td>
<select name="orderby">
<?php
$qx = $db->select("menu");
while($datax = $db->fetch_array($qx)) {
$selected='';
if($datax['id'] == $data['orderby']) $selected ='selected="selected"'; 
_e('<option value="'.$datax['id'].'" '.$selected.'>'.uc_first($datax['title']).'</option>');
}
?></select>
	</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>
	  <button name="submit" class="primary"><span class="icon pen"></span>Save & Update</button> or <button name="Reset"><span class="icon loop"></span>Reset</button></td>
    </tr>
  </table></form>
<?php

}else{
	
if(isset($_POST['submit'])){
	$title = esc_sql($_POST['title']);
	if( empty($title) ) _e('<div id="error"><strong>ERROR</strong>: Title is empty.</div>');
	else update_menu( compact('title'),$id );
}
$q		= $db->select("menu",compact('id'));
$data   = $db->fetch_array($q);
?>
<form action="" method="post" enctype="multipart/form-data" name="form1">
  <table>
    <tr>
      <td width="4%">Title</td>
      <td width="1%"><strong>:</strong></td>
      <td width="95%"><input type="text" style="width:300px;" name="title" value="<?php _e($data['title'])?>"></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td width="95%">
	  <button name="submit" class="primary"><span class="icon pen"></span>Save & Update</button> or <button name="Reset"><span class="icon loop"></span>Reset</button>
    </tr>
  </table></form>
<?php
}
break;
case'add':
if($to=='userpanel'){
if(isset($_POST['submit'])){
	
	$title 			= 		esc_sql( $_POST['title']	);
	$url 			= 		esc_sql( $_POST['url']		);
	
	if( empty($title) ) _e('<div id="error"><strong>ERROR</strong>: Title is empty.</div>');
	if( empty($url) ) _e('<div id="error"><strong>ERROR</strong>: URL is empty.</div>');
	
	else add_menu_user( compact('title','url') );
}
?>
<form action="" method="post" enctype="multipart/form-data" name="form1">
  <table width="100%" border="0" cellspacing="1" cellpadding="0">
    <tr>
      <td width="5%">Title</td>
      <td width="1%"><strong>:</strong></td>
      <td width="94%"><input type="text" name="title" class="input" size="20"></td>
    </tr>
    <tr>
      <td>Url</td>
      <td><strong>:</strong></td>
      <td><textarea name="url" style="width:400px;"></textarea></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>
	  <button name="submit" class="primary"><span class="icon plus"></span>Add</button> or <button name="Reset"><span class="icon loop"></span>Reset</button></td>
    </tr>
  </table>
</form>
<?php
}elseif($to=='sub'){
	
if(isset($_POST['submit'])){
	$title 			= 		esc_sql( $_POST['title']	);
	$url 			= 		esc_sql( $_POST['url']		);
	$orderby 		= (int) esc_sql( $_POST['orderby'] 	);
	if( empty($title) ) _e('<div id="error"><strong>ERROR</strong>: Title is empty.</div>');
	if( empty($url) ) _e('<div id="error"><strong>ERROR</strong>: URL is empty.</div>');
	
	else add_sub_menu( compact('title','url','orderby') );

}
?>
<form action="" method="post" enctype="multipart/form-data" name="form1">
  <table>
    <tr>
      <td width="5%">Title</td>
      <td width="1%"><strong>:</strong></td>
      <td width="94%"><input type="text" name="title" ></td>
    </tr>
    <tr>
      <td valign="top">Url</td>
      <td valign="top"><strong>:</strong></td>
      <td><textarea name="url" style="width:400px;"></textarea></td>
    </tr>
    <tr>
      <td>Order</td>
      <td><strong>:</strong></td>
      <td>
  <select name="orderby" class=select>
<?php 
$q = $db->select("menu",null,'ORDER BY id' );             
while ($data = $db->fetch_array($q)) {       	
echo'<option value="'.$data['id'].'">'.$data['title'].'</option>';            
}
?>
  </select>
    </td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>
	  <button name="submit" class="primary"><span class="icon plus"></span>Add</button> or <button name="Reset"><span class="icon loop"></span>Reset</button></td>
    </tr>
  </table></form>
<?php
}else{

if(isset($_POST['submit'])){
	$title 			= $_POST['title'];
	if( empty($title) ) _e('<div id="error"><strong>ERROR</strong>: Title is empty.</div>');
	else add_menu(compact('title'));

}
?>
<form action="" method="post" enctype="multipart/form-data" name="form1">
  <table>
    <tr>
      <td width="4%">Title</td>
      <td width="1%"><strong>:</strong></td>
      <td width="95%"><input type="text" style="width:300px;" name="title"></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td width="95%">
	  <button name="submit" class="primary"><span class="icon plus"></span>Add</button> or <button name="Reset"><span class="icon loop"></span>Reset</button>
    </tr>
  </table></form>
<?php
}
break;
}
?>
</div>


