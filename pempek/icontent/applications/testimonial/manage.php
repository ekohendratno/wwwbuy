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

<div class="box-head dotted">Testimonial Manager</div>
<div id="box-content">
<?php
global $iw,$db;
$go 	= filter_txt($_GET['go']);
$act	= filter_txt($_GET['act']);
$pub	= filter_txt($_GET['pub']);
$id 	= filter_int($_GET['id']);
$offset	= filter_int($_GET['offset']);

$widget = array(
'menu'		=> menu(),
'help_desk' => 'Memungkinkan anda memanage testimonial'
);

switch($go){
default:
if($act == 'pub' && !empty($act)){
	if ($pub == 'no') $stat =0;	
	if ($pub == 'yes') $stat =1;
	update_testimonial(array('status'=>$stat),$id);
}
if($act == 'del' && !empty($act)){
	del_testimonial($id); 
}
$limit		= 10;
$a			= new paging_admin();
$q			= $a->query( "SELECT * FROM `".$iw->pre."testimonial` WHERE status='1' ORDER BY `id` DESC", $limit);
?>
<form action="" method="post" >
<table width="100%" cellpadding="0" cellspacing="0" id=table>
<tr class="head">
    <td width="43%" class="depan"><strong>Name</strong></td>
	<td class="depan"><div align="center"><strong>Status</strong></div></td>
    <td colspan="2" class="depan"><div align="center"><strong>Action</strong></div></td>
</tr>
<?php
$warna = '';
while ($data = $db->fetch_array($q)) {
$id 	= $data['id'];
$warna  = empty ($warna) ? ' bgcolor="#f1f6fe"' : '';

$status = ($data['status'] == 1) ? '<a  class="enable" title="Enable" href="?admin&apps=testimonial&act=pub&pub=no&id='.$id.'">Enable</a>' : '<a  class="disable" title="Disable" href="?admin&apps=testimonial&act=pub&pub=yes&id='.$id.'">Disable</a>';

?>
<tr <?php _e($warna)?> class="isi">
	<td><b><?php _e($data['nama'])?></b><br /><?php _e(limittxt($data['pesan'],50));?></td>
	<td><div align="center"><?php _e($status)?></div></td>
    <td>
    <div align="center">
<a href="?admin&apps=testimonial&go=edit&type=<?php _e($typed)?>&id=<?php _e($id)?>" class="edit" title="edit">edit</a>
<a href="?admin&apps=testimonial&act=del&id=<?php _e($id)?>" class="delete" title="delete" onclick="return confirm('Are You sure delete this sidebar?')">delete</a>
    </div>
    </td>
</tr>
<?php
}
?>
</table>
<!--halaman navigasi-->
<div id="num">
<?php _e($a->pg('?admin&apps=testimonial'));?>
</div>
</form>
<?php
break;
case'unaproved':
if($act == 'pub' && !empty($act)){
	if ($pub == 'no') $stat =0;	
	if ($pub == 'yes') $stat =1;
	update_testimonial(array('status'=>$stat),$id);
}
if($act == 'del' && !empty($act)){
	del_testimonial($id); 
}
$limit		= 10;
$a			= new paging_admin();
$q			= $a->query( "SELECT * FROM `".$iw->pre."testimonial` WHERE status='0' ORDER BY `id` DESC", $limit);
?>
<form action="" method="post" >
<table width="100%" cellpadding="0" cellspacing="0" id=table>
<tr class="head">
    <td width="43%" class="depan"><strong>Name</strong></td>
	<td class="depan"><div align="center"><strong>Status</strong></div></td>
    <td colspan="2" class="depan"><div align="center"><strong>Action</strong></div></td>
</tr>
<?php
$warna = '';
while ($data = $db->fetch_array($q)) {
$id 	= $data['id'];
$warna  = empty ($warna) ? ' bgcolor="#f1f6fe"' : '';

$status = ($data['status'] == 1) ? '<a  class="enable" title="Enable" href="?admin&apps=testimonial&go=unaproved&act=pub&pub=no&id='.$id.'">Enable</a>' : '<a  class="disable" title="Disable" href="?admin&apps=testimonial&go=unaproved&act=pub&pub=yes&id='.$id.'">Disable</a>';

?>
<tr <?php _e($warna)?> class="isi">
	<td><b><?php _e($data['nama'])?></b><br /><?php _e(limittxt($data['pesan'],50));?></td>
	<td><div align="center"><?php _e($status)?></div></td>
    <td>
    <div align="center">
<a href="?admin&apps=testimonial&go=edit&type=<?php _e($typed)?>&id=<?php _e($id)?>" class="edit" title="edit">edit</a>
<a href="?admin&apps=testimonial&go=unaproved&act=del&id=<?php _e($id)?>" class="delete" title="delete" onclick="return confirm('Are You sure delete this sidebar?')">delete</a>
    </div>
    </td>
</tr>
<?php
}
?>
</table>
<!--halaman navigasi-->
<div id="num">
<?php _e($a->pg('?admin&apps=testimonial'));?>
</div>
</form>
<?php
break;
case'edit':

if(isset($_POST['submit'])){
	
	$nama 			= 		esc_sql( $_POST['nama']	);
	$email 			= 		esc_sql( $_POST['email']		);
	$pesan 			= 		esc_sql( $_POST['pesan']		);
	
	if( empty($nama) ) _e('<div id="error"><strong>ERROR</strong>: Nama is empty.</div>');
	if( empty($email) ) _e('<div id="error"><strong>ERROR</strong>: Email is empty.</div>');
	if( empty($pesan) ) _e('<div id="error"><strong>ERROR</strong>: Pesan is empty.</div>');
	
	else update_testimonial( compact('nama','email','pesan'), $id);
}
$q		= $db->select("testimonial",compact('id'));
$data   = $db->fetch_array($q);
?>
<form action="" method="post" enctype="multipart/form-data" name="form1">
  <table width="100%" border="0" cellspacing="1" cellpadding="0">
    <tr>
      <td width="5%">Nama</td>
      <td width="1%"><strong>:</strong></td>
      <td width="94%"><input type="text" name="nama" class="input" size="20" style="width:200px;" value="<?php _e($data['nama'])?>"></td>
    </tr>
    <tr>
      <td width="5%">Email</td>
      <td width="1%"><strong>:</strong></td>
      <td width="94%"><input type="text" name="email" class="input" size="20"  style="width:300px;" value="<?php _e($data['email'])?>"></td>
    </tr>
    <tr>
      <td>Pesan</td>
      <td><strong>:</strong></td>
      <td><textarea name="pesan" style="width:400px; height:100px;"><?php _e($data['pesan'])?></textarea></td>
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
break;
}
?>
</div>
