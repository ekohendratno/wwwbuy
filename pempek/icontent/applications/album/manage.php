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

<div class="box-head dotted">Album Manager</div>
<div id="box-content">
<?php
global $iw,$db;

$go 	= filter_txt($_GET['go']);
$to 	= filter_txt($_GET['to']);
$act	= filter_txt($_GET['act']);
$pub 	= filter_txt($_GET['pub']);
$id 	= filter_int($_GET['id']);

$widget = array(
'menu'		=> menu(),
'help_desk' => 'Memungkinkan anda menambahkan/ mengupload beberapa foto ke foto album pada web anda'
);

switch($go){
default:
if($to == 'cat'){
	
if($act == 'pub' && !empty($act)){
	if ($pub == 'no') $status =0;	
	if ($pub == 'yes') $status =1;
	update_album(compact('status'),$id);
}
if($act == 'del' && !empty($act)){
	del_album($id); 
}
?>
<table id=table cellpadding="0" cellspacing="0">
<tr class="head">
    <td class="depan"><strong>Title</strong></td>
	<td class="depan"><div align="center"><strong>Status</strong></div></td>
    <td class="depan"><div align="center"><strong>Action</strong></div></td>
</tr>
<?php
$limit	= 10;
$a		= new paging_admin();
$q		= $a->query( "SELECT * FROM `".$iw->pre."album_cat`  ORDER BY id DESC", $limit);
$warna 	= '';
while ($r = $db->fetch_obj($q)) {
$warna 	= empty ($warna) ? ' bgcolor="#f1f6fe"' : '';

$status = ($r->status == 1) ? '<a  class="enable" title="Enable" href="?admin&apps=album&to=cat&act=pub&pub=no&id='.$r->id.'">Enable</a>' : '<a  class="disable" title="Disable" href="?admin&apps=album&to=cat&act=pub&pub=yes&id='.$r->id.'">Disable</a>';
?>
<tr <?php _e($warna)?> class="isi">
	<td style="border-right:0;"><?php _e($r->title)?></td>
	<td><div align="center"><?php _e($status)?></div></td>
    <td>
    <div align="center">
<a href="?admin&apps=album&go=edit&to=cat&id=<?php _e($r->id)?>" class="edit" title="edit">edit</a>
<a href="?admin&apps=album&to=cat&act=del&id=<?php _e($r->id)?>" class="delete" title="delete" onclick="return confirm('Are You sure delete this album?')">delete</a>
    </div>
   </td>
</tr>
<?php }?>
</table>
<div class=num style="height:24px;">
<div class="right">
<a href="?admin&apps=album&go=add" class="button">Add Foto</a>
<a href="?admin&apps=album&go=add&to=cat" class="button">Add Category</a>
</div>
</div>
<!--halaman navigasi-->
<div id="num">
<?php _e($a->pg('?admin&apps=album&to=cat'));?>
</div>
<?php

}else{
	
if($act == 'pub' && !empty($act)){
	if ($pub == 'no') $status =0;	
	if ($pub == 'yes') $status =1;
	update_foto(compact('status'),$id);
}
if($act == 'del' && !empty($act)){
	del_foto($id); 
}
?>
<table id=table cellpadding="0" cellspacing="0">
<tr class="head">
<td class="depan"><strong>Title</strong></td>
<td class="depan"><strong>Category</strong></td>
<td class="depan"><div align="center"><strong>Status</strong></div></td>
<td class="depan"><div align="center"><strong>Action</strong></div></td>
</tr>
<?php
$limit	= 10;
$a		= new paging_admin();
$q		= $a->query( "SELECT * FROM `".$iw->pre."album`  ORDER BY id DESC", $limit);
$warna 	= '';
while ($r = $db->fetch_obj($q)) {
	
$warna 	= empty ($warna) ? ' bgcolor="#f1f6fe"' : '';
$c      = $db->fetch_obj( $db->select('album_cat',array('id' => $r->cat)) );

$status = ($r->status == 1) ? '<a  class="enable" title="Enable" href="?admin&apps=album&act=pub&pub=no&id='.$r->id.'">Enable</a>' : '<a  class="disable" title="Disable" href="?admin&apps=album&act=pub&pub=yes&id='.$r->id.'">Disable</a>';

?>
<tr <?php _e($warna)?> class="isi">
	<td><?php _e($r->title)?></td>
	<td><?php _e($c->title)?></td>
	<td><div align="center"><?php _e($status)?></div></td>
    <td>
    <div align="center">
<a href="?admin&apps=album&go=edit&id=<?php _e($r->id)?>" class="edit" title="edit">edit</a>
<a href="?admin&apps=album&act=del&id=<?php _e($r->id)?>" class="delete" title="delete" onclick="return confirm('Are You sure delete this album?')">delete</a>
    </div>
    </td>
</tr>
<?php }?>
</table>
<div class=num style="height:24px;">
<div class="right">
<a href="?admin&apps=album&go=add" class="button">Add Foto</a>
<a href="?admin&apps=album&go=add&to=cat" class="button">Add Category</a>
</div>
</div>
<!--halaman navigasi-->
<div id="num">
<?php _e($a->pg('?admin&apps=album'));?>
</div>
<?php
}
break;
case'add':
if($to == 'cat'){
	
if(isset($_POST['submit'])){
	$msg 	= array();
	$title 	= filter_txt($_POST['title']);
	
	if(empty($title)) _e('<div id="error"><strong>ERROR</strong>: The title is empty.</div>');
	else insert_album(compact('title'));
}
?>
<form action="" method="post">
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr>
      <td width="6%" align="left" valign="middle">Title</td>
      <td width="1%" align="left" valign="middle"><strong>:</strong></td>
      <td width="93%" align="left" valign="middle">
      <input type="text" name="title" class="input" style="width:200px"></td>
    </tr>
    <tr>
      <td align="left" valign="top">&nbsp;</td>
      <td align="left" valign="top">&nbsp;</td>
      <td align="left" valign="top"><button name="submit" class="primary"><span class="icon plus"></span>Add</button> or <button name="Reset"><span class="icon loop"></span>Reset</button></td>
    </tr>
  </table>
</form>
<?php

}else{

if(isset($_POST['submit'])){
	$title 		= filter_txt($_POST['title']);
	$desc 		= filter_txt($_POST['desc']);
	$cat 		= filter_int($_POST['cat']);
	$thumb	 	= $_FILES['thumb'];
	$thumb	 	= hash_image( $thumb );
	
	$data = compact('title','desc','cat','thumb');
	insert_foto($data);
}
?>
<form action="" method="post" enctype="multipart/form-data">
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr>
      <td width="6%" align="left" valign="middle">Title</td>
      <td width="1%" align="left" valign="middle"><strong>:</strong></td>
      <td width="93%" align="left" valign="middle">
      <input type="text" name="title" style="width:300px"></td>
    </tr>
    <tr>
      <td align="left" valign="top">Desc</td>
      <td align="left" valign="top"><strong>:</strong></td>
      <td align="left" valign="top">
      <textarea name="desc" rows="5" cols="50"></textarea></td>
    </tr>
    <tr>
      <td align="left" valign="middle">Category</td>
      <td align="left" valign="middle"><strong>:</strong></td>
      <td align="left" valign="middle">
      <select  class="select" name="cat">
      <option value="">Pilih Kategori Album</option>
     <?php
     $q = $db->select('album_cat');
     while($r = $db->fetch_obj($q)){
        echo '<option value="'.$r->id.'">'.$r->title.'</option>';
     }
     ?>
    </select>
    </td>
    </tr>
    <tr>
      <td align="left" valign="middle">Image</td>
      <td align="left" valign="middle"><strong>:</strong></td>
      <td align="left" valign="middle"><input type="file" name="thumb"></td>
    </tr>
    <tr>
      <td align="left" valign="top">&nbsp;</td>
      <td align="left" valign="top">&nbsp;</td>
      <td align="left" valign="top"><button name="submit" class="primary"><span class="icon plus"></span>Add</button> or <button name="Reset"><span class="icon loop"></span>Reset</button></td>
    </tr>
  </table></form>
<?php
	
}
break;
case'edit':
if($to == 'cat'){
	
if(isset($_POST['submit'])){
	$msg 	= array();
	$title 	= filter_txt($_POST['title']);
	
	if(empty($title)) _e('<div id="error"><strong>ERROR</strong>: The title is empty.</div>');
	else update_album(compact('title'),$id);
}
$r = view_album( $id );
?>
<form action="" method="post">
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr>
      <td width="6%" align="left" valign="middle">Title</td>
      <td width="1%" align="left" valign="middle"><strong>:</strong></td>
      <td width="93%" align="left" valign="middle">
      <input type="text" name="title" class="input" style="width:200px" value="<?php _e($r->title)?>"></td>
    </tr>
    <tr>
      <td align="left" valign="top">&nbsp;</td>
      <td align="left" valign="top">&nbsp;</td>
      <td align="left" valign="top"><button name="submit" class="primary"><span class="icon pen"></span>Save & Update</button> or <button name="Reset"><span class="icon loop"></span>Reset</button></td>
    </tr>
  </table>
</form>
<?php

}else{

$widget = array(
'menu'		=> menu(),
'gadget' 	=> array( gadget_foto($id) ),
'help_desk' => 'Memungkinkan anda menambahkan/ mengupload beberapa foto ke foto album pada web anda'
);
if(isset($_POST['submit'])){
	$title 		= filter_txt($_POST['title']);
	$desc 		= filter_txt($_POST['desc']);
	$cat 		= filter_int($_POST['cat']);
	$thumb	 	= $_FILES['thumb'];
	$thumb	 	= hash_image( $thumb );
	
	$data = compact('title','desc','cat','thumb');
	edit_foto($data,$id);
}
$r = view_foto( $id );
?>
<form action="" method="post" enctype="multipart/form-data">
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr>
      <td width="6%" align="left" valign="middle">Title</td>
      <td width="1%" align="left" valign="middle"><strong>:</strong></td>
      <td width="93%" align="left" valign="middle">
      <input type="text" name="title" style="width:300px" value="<?php _e($r->title)?>"></td>
    </tr>
    <tr>
      <td align="left" valign="top">Desc</td>
      <td align="left" valign="top"><strong>:</strong></td>
      <td align="left" valign="top">
      <textarea name="desc" rows="5" cols="50"><?php _e($r->desc)?></textarea></td>
    </tr>
    <tr>
      <td align="left" valign="middle">Category</td>
      <td align="left" valign="middle"><strong>:</strong></td>
      <td align="left" valign="middle">
      <select  class="select" name="cat">
      <option value="">Pilih Kategori Album</option>
     <?php
     $query_cat = $db->select('album_cat');
     while($r_cat = $db->fetch_obj($query_cat)){
		 $selected =  '';
		 if($r_cat->id == $r->cat) $selected = 'selected="selected"';
		 
         echo '<option value="'.$r_cat->id.'" '.$selected.'>'.$r_cat->title.'</option>';
     }
     ?>
    </select>
    </td>
    </tr>
    <tr>
      <td align="left" valign="middle">Image</td>
      <td align="left" valign="middle"><strong>:</strong></td>
      <td align="left" valign="middle"><input type="file" name="thumb"></td>
    </tr>
    <tr>
      <td align="left" valign="top">&nbsp;</td>
      <td align="left" valign="top">&nbsp;</td>
      <td align="left" valign="top"><button name="submit" class="primary"><span class="icon pen"></span>Save & Update</button> or <button name="Reset"><span class="icon loop"></span>Reset</button></td>
    </tr>
  </table></form>
<?php
	
}
break;

}
?>
</div>
