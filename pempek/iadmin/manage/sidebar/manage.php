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

<div class="box-head dotted">Sidebar</div>
<div id="box-content">
<?php
global $iw,$db;
$go 	= filter_txt($_GET['go']);
$act	= filter_txt($_GET['act']);
$to 	= filter_txt($_GET['to']);
$pub 	= filter_txt($_GET['pub']);
$type 	= filter_txt($_GET['type']);
$id 	= filter_int($_GET['id']);

$widget = array(
'menu'		=> menu(),
'help_desk' => 'Memungkinkan anda mengatur, menambah, serta mengubah posisi sidebar'
);
switch($go){
default:
if(isset($_POST['submit'])){
	$id_sidebar   = esc_sql( $_POST['id'] 	);
	$order_sidebar= esc_sql( $_POST['order'] 	);
	update_order_sidebar(compact('id_sidebar','order_sidebar'));
}	
if($act == 'pub' && !empty($act)){
if($to == 'actions'){
	if ($pub == 'no') $app =0;	
	if ($pub == 'yes') $app =1;
	update_sidebar(array('aplikasi'=>$app),$id); 
}elseif($to == 'posisi'){
	if ($pub == 'left') $posisi =0;	
	if ($pub == 'right') $posisi =1;
	update_sidebar(array('position'=>$posisi),$id); 
}else{
	if ($pub == 'no') $stat =0;	
	if ($pub == 'yes') $stat =1;
	update_sidebar(array('status'=>$stat),$id);
}
}
if($act == 'del' && !empty($act)){
	del_sidebar($id); 
}
$limit		= 10;
$a			= new paging_admin();
$q			= $a->query( "SELECT * FROM `".$iw->pre."sidebar` ORDER BY `ordering`", $limit);
?>
<form action="" method="post" enctype="multipart/form-data" name="form1">
<table width="100%" cellpadding="0" cellspacing="0" id=table>
<tr class="head">
    <td width="43%" class="depan"><strong>Name</strong></td>
	<td class="depan"><div align="center"><strong>Ordering</strong></div></td>
	<td class="depan"><div align="center"><strong>Status</strong></div></td>
	<td class="depan"><div align="center"><strong>Actions</strong></div></td>
	<td class="depan"><div align="center"><strong>Position</strong></div></td>
	<td class="depan"><div align="center"><strong>Type</strong></div></td>
    <td colspan="2" class="depan"><div align="center"><strong>Action</strong></div></td>
</tr>
<?php
$warna = '';
while ($data = $db->fetch_array($q)) {
$id 	= $data['id'];
$warna  = empty ($warna) ? ' bgcolor="#f1f6fe"' : '';

$status = ($data['status'] == 1) ? '<a  class="enable" title="Enable" href="?admin&sys=sidebar&act=pub&pub=no&id='.$id.'">Enable</a>' : '<a  class="disable" title="Disable" href="?admin&sys=sidebar&act=pub&pub=yes&id='.$id.'">Disable</a>';

$actions = ($data['aplikasi'] == 1) ? '<a class="enable" title="Enable" href="?admin&sys=sidebar&act=pub&to=actions&pub=no&id='.$id.'">Enable</a>' : '<a class="disable" title="Disable" href="?admin&sys=sidebar&act=pub&to=actions&pub=yes&id='.$id.'">Disable</a>';

$position = ($data['position'] == 1) ? '<a class="s-right" title="Right" href="?admin&sys=sidebar&act=pub&to=posisi&pub=left&id='.$id.'">Right</a>' : '<a class="s-left" title="Left" href="?admin&sys=sidebar&act=pub&to=posisi&pub=right&id='.$id.'">Left</a>';

?>
<tr <?php _e($warna)?> class="isi">
	<td><?php _e($data['title'])?></td>
	<td><div align="center">
    <input type="text" name="order[]" style="width:20px;" value="<?php _e($data['ordering'])?>"/>
    <input type="hidden" name="id[]" size="2" value="<?php _e($data['id'])?>"/>
    </div></td>
	<td><div align="center"><?php _e($status)?></div></td>
	<td><div align="center"><?php _e($actions)?></div></td>
	<td><div align="center"><?php _e($position)?></div></td>
	<td><div align="center">
<?php
if($data['type']=='app'){ $typed ='app'; _e('<span class="apps" title="Apps"></span>');}
if($data['type']=='block'){ $typed ='block'; _e('<span class="blocks" title="Blocks"></span>');}
?>
    </div>
    </td>
    <td>
    <div align="center">
<a href="?admin&sys=sidebar&go=edit&type=<?php _e($typed)?>&id=<?php _e($id)?>" class="edit" title="edit">edit</a>
<a href="?admin&sys=sidebar&act=del&id=<?php _e($id)?>" class="delete" title="delete" onclick="return confirm('Are You sure delete this sidebar?')">delete</a>
    </div>
    </td>
</tr>
<?php
}
?>
</table>
<div class=num style="height:24px;">
<div class="left">
<button name="submit" class="primary"><span class="icon pen"></span>Save & Update</button> or <button name="Reset"><span class="icon loop"></span>Reset</button>
</div>
<div class="right">
<a href="?admin&amp;sys=sidebar&go=add&act=add&type=app" class="xleft button"><span class="icon plus"></span>Add Apps</a>
<a href="?admin&amp;sys=sidebar&go=add&act=add&type=block" class="xmiddle button"><span class="icon plus"></span>Add Blocks</a>
<a href="?admin&amp;sys=sidebar&go=add&act=actions" class="xright button"><span class="icon plus"></span>Add Actions</a>
</div>
</div>
<!--halaman navigasi-->
<div id="num">
<?php _e($a->pg('?admin&sys=sidebar'));?>
</div>
</form>
<?php
break;
case'actions':
if($act == 'del' && !empty($act)){
	if($to == 'actions'){
	$aplikasi 	= filter_txt($_GET['load_apps']);
	del_action_sidebar(compact('aplikasi'));  
	}
}
$limit		= 10;
$a			= new paging_admin();
$q			= $a->query("SELECT * FROM `".$iw->pre."sidebar_act` GROUP BY aplikasi", $limit);
?>
<table id=table cellpadding="0" cellspacing="0" width="100%">
  <tr class="head">
    <td width="43%" class="depan"><strong>Aplication</strong></td>
    <td width="23%" class="depan"><center><strong>Leftside</strong></center></td>
    <td width="23%" class="depan"><center><strong>Rightside</strong></center></td>
    <td colspan="2" class="depan"><div align="center"><strong>Action</strong></div></td>
  </tr>
<?php
$warna 	= '';
while ($data = $db->fetch_array($q)) {
$id 		= $data['id'];
$id_sidebar	= $data['id_sidebar'];
$aplikasi	= $data['aplikasi'];
$warna 	= empty ($warna) ? ' bgcolor="#f1f6fe"' : '';

?>
  <tr <?php _e($warna)?> class="isi">
	<td><?php _e(uc_first($aplikasi))?></td>
	<td align="center">( <?php echo count_action_sidebar(array('aplikasi'=>$aplikasi,'posisi'=>0))?> ) widget</td>
	<td align="center">( <?php echo count_action_sidebar(array('aplikasi'=>$aplikasi,'posisi'=>1))?> ) widget</td>
    <td>
    <div align="center">
<a href="?admin&sys=sidebar&go=edit&to=actions&load_apps=<?php _e($data['aplikasi'])?>" class="edit" title="edit">edit</a>
<a href="?admin&sys=sidebar&go=actions&act=del&to=actions&load_apps=<?php _e($data['aplikasi'])?>" class="delete" title="delete" onclick="return confirm('Are You sure delete this sidebar?')">delete</a>
    </div>
    </td>
  </tr>
<?php
}
?>
</table>
<div class=num style="height:24px;">
<div class="right">
<a href="?admin&amp;sys=sidebar&go=add&act=actions" class="button"><span class="icon plus"></span>Add Actions</a>
</div>
</div>
<!--halaman navigasi-->
<div id="num">
<?php _e($a->pg('?admin&sys=sidebar&go=actions'));?>
</div>
<?php
break;
case'add':
if(empty($act)){
	redirect('?admin&sys=sidebar');
}
if($act == 'actions' && !empty($act)){

if(isset($_POST['submit'])){
	$aplikasi	= filter_txt($_POST['aplikasi']);
	$posisi		= filter_int($_POST['posisi']);
	$id_sidebar	= filter_int($_POST['sidebar']);
	
	$data = compact('aplikasi','posisi','id_sidebar');
	insert_action_sidebar($data);
}
?>
<form action="" method="post">
  <table width="100%" border="0" cellspacing="2" cellpadding="0">
    <tr>
      <td width="19%">Action</td>
      <td width="1%"><strong>:</strong></td>
      <td width="80%">
<select name="aplikasi">
<?php
foreach( list_app() as $key ){
echo'<option value="'.$key.'">'.uc_first($key).'</option>';
}
?></select></td>
    </tr>
    <tr>
      <td>Add to Actions</td>
      <td><strong>:</strong></td>
      <td>
<select name="sidebar">
<?php
$q = $db->select("sidebar",null,'ORDER BY ordering');
while($data = $db->fetch_array($q)) {
$status = $data['status'] ? 'Publish' : 'UnPublish';
_e('<option value="'.$data['id'].'">'.uc_first($data['title']).' - '.uc_first($status).'</option>');
}
?></select></td>
    </tr>
    <tr>
      <td>Posisi</td>
      <td><strong>:</strong></td>
      <td><select name="posisi">
        <option value="0">Leftside</option>
        <option value="1">Rightside</option>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><button name="submit" class="primary"><span class="icon plus"></span>Add</button> or <button name="Reset"><span class="icon loop"></span>Reset</button></td>
    </tr>
  </table>
</form>
<?php
}
if($act == 'add' && !empty($act)){	
if(isset($_POST['submit'])){
	$msg 	= array();
	$title 	= filter_txt($_POST['title']);
	
	if(empty($title)) _e('<div id="error"><strong>ERROR</strong>: The title is empty.</div>');
	
	if($type == 'app'){
	$file  	= filter_txt($_POST['file']);
	insert_sidebar(compact('title','file','type'));
	}
	
	if($type == 'block'){
	$coder 	= $_POST['coder'];
	insert_sidebar(compact('title','coder','type'));
	}
	
}

?>
<form action="" method="post" enctype="multipart/form-data" name="form1">
<table style="width:800px;">
<?php
if($type == 'app'){
?>
      <tr>
        <td colspan="2">Name*</td>
      </tr>
      <tr>
        <td width="86%" colspan="2"><label>
         <input type="text" name="title" style="width:50%;">
        </label> * ex : Title Apps</td>
      </tr>
	   <tr>
	     <td>File Source*</td>
  </tr>
	   <tr>
        <td><textarea name="file" style="width:400px; height:100px;"></textarea>* ex : name-apps/files-apps.php</td>
      </tr>
<?php
}
if($type == 'block'){
?>
    <style type=text/css>
	 .CodeMirror-scroll {
		 width		:400px;		 
	 }
     iframe#textcode_preview {
		 width		:300px;	
         height		:300px;
		 border		:1px solid #ddd;
		 overflow	:auto;
     }
    </style>
      <tr>
        <td colspan="2">Name*</td>
      </tr>
      <tr>
        <td width="86%" colspan="2"><label>
         <input type="text" name="title" style="width:50%;">
        </label>&nbsp;* ex : Status Ym</td>
      </tr>     
	   <tr>
	     <td valign="top">Code HTML</td>
	     <td colspan="2" align="left" valign="top">Preview</td>
      </tr>
	   <tr>
        <td valign="top" width="50%"><textarea name="coder" id="textcode"></textarea></td>
        <td colspan="2" align="left" valign="top"><iframe id="textcode_preview"></iframe></td>
      </tr>
<?php
}
?>
	  <tr>
        <td colspan="2"><button name="submit" class="primary"><span class="icon plus"></span>Add</button> or <button name="Reset"><span class="icon loop"></span>Reset</button></td>
      </tr>
</table>
</form>
<?php
}
break;
case'edit':
if($to == 'actions'){
if($act == 'del' && !empty($act)){
	del_action_sidebar(compact('id')); 
}
$aplikasi=filter_txt($_GET['load_apps']);
echo'<div class="num" style="text-align:left">'.uc_first($aplikasi).'</div>';

if (isset($_POST['submit'])) {
	$posisi= $_POST['posisi']; 
	$order = $_POST['order'];
	update_action_sidebar($posisi,$order);
}

$limit		= 10;
$a			= new paging_admin();
$q			= $a->query("
SELECT `".		$iw->pre."sidebar_act`.*,`".
				$iw->pre."sidebar`.`title` 
FROM `".		$iw->pre."sidebar_act` 
LEFT JOIN `".	$iw->pre."sidebar` 
ON (`".			$iw->pre."sidebar`.`id` = `".
				$iw->pre."sidebar_act`.`id_sidebar`) 
WHERE `".		$iw->pre."sidebar_act`.`aplikasi` = '$aplikasi' 
ORDER BY `".	$iw->pre."sidebar_act`.`order`", $limit);

if($db->num($q)<1){
	redirect('?admin&sys=sidebar&go=actions');
}
?>
<form action="" method="post" enctype="multipart/form-data">
<table id=table cellpadding="0" cellspacing="0">
<tr class="head">
    <td width="53%" class="depan"><strong>Kiri</strong></td>
    <td width="53%" class="depan"><strong>Kanan</strong></td>
    <td width="53%" class="depan"><div align="center"><strong>Posisi</strong></div></td>
    <td width="53%" class="depan"><div align="center"><strong>Order</strong></div></td>
    <td class="depan"><div align="center"><strong>Action</strong></div></td>
  </tr>
<?php
$warna = '';
while ($data = $db->fetch_array($q)) {
$id 		= $data['id'];
$warna 		= empty ($warna) ? ' bgcolor="#f1f6fe"' : '';
$left	 	= ($data['posisi'] == 0) ? $data['title'] : '---&raquo;';
$right	 	= ($data['posisi'] == 1) ? $data['title'] : '&laquo;---';
echo'<tr'.$warna.' class="isi">
	<td>'.$left.'</td>
	<td>'.$right.'</td>
	<td align="right"><select name="posisi['.$id.']">';
if($data['posisi']==1){
	echo'
        <option value="0">Kiri</option>
        <option value="1" selected="selected">Kanan</option>';
}else{
	echo'
        <option value="0" selected="selected">Kiri</option>
        <option value="1">Kanan</option>';
}
?>
      </select></td>
	<td><input type="text" name="order[<?php _e($id)?>]" size="3" value="<?php _e($data['order'])?>" style="width:20px;"></td>
    <td width="5%">
	<div align="center">
<a href="?admin&sys=sidebar&go=edit&to=actions&load_apps=users&act=del&id=<?php _e($id)?>" class="delete" title="delete" onclick="return confirm('Are You sure delete this actions sidebar?')">delete</a>
	</div>
	</td>
</tr>
<?php
}
?>
</table>
<div class=num style="height:24px;">
<div class="left">
<button name="submit" class="primary"><span class="icon pen"></span>Save & Update</button> or <button name="Reset"><span class="icon loop"></span>Reset</button>
</div>
<div class="right">
<a href="?admin&amp;sys=sidebar&go=add&act=actions" class="button"><span class="icon plus"></span>Add Actions</a>
</div>
</div>
</form>
<!--halaman navigasi-->
<div id="num">
<?php _e($a->pg('?admin&sys=sidebar&go=edit&to=actions&load_apps='.filter_txt( $_GET['load_apps']) ));?>
</div>
<?php
}else{
if($type !=='app' && $type !=='block'){
	redirect('?admin&sys=sidebar');
}
if(isset($_POST['submit'])){
	$msg 	= array();
	$title 	= filter_txt($_POST['title']);
	
	if(empty($title)) _e('<div id="error"><strong>ERROR</strong>: The title is empty.</div>');
	
	if($type == 'app'){
	$file  	= filter_txt($_POST['file']);
	update_sidebar(compact('title','file'),$id);
	}
	
	if($type == 'block'){
	$coder 	= $_POST['coder'];
	update_sidebar(compact('title','coder'),$id);
	}
	
}

$q		= $db->select("sidebar",compact('id'));
$data   = $db->fetch_array($q);
?>
<form action="" method="post" enctype="multipart/form-data" name="form1">
<table width="100%">
<?php
if($type == 'app'){
?>
      <tr>
        <td>Name*</td>
        <td width="1%">&nbsp;</td>
        <td width="86%">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3"><label>
          <input type="text" name="title" style="width:50%;" value="<?php _e($data['title'])?>">
        </label> * ex : Title Apps</td>
      </tr>
	   <tr>
	     <td colspan="3" valign="top">File Source*</td>
      </tr>
	   <tr>
        <td colspan="3" valign="top"><textarea name="file" style="width:400px; height:100px;"><?php _e($data['file'])?></textarea><br />* ex : name-apps/files-apps.php</td>
      </tr>
<?php
}
if($type == 'block'){
?>
    <style type=text/css>
	 .CodeMirror-scroll {
		 width		:400px;		 
	 }
     iframe#textcode_preview {
		 width		:300px;	
         height		:300px;
		 border		:1px solid #ddd;
		 overflow	:auto;
     }
    </style>
      <tr>
        <td colspan="3">Name*</td>
      </tr>
      <tr>
        <td colspan="3">
          <label>
            <input type="text" name="title" style="width:50%;" value="<?php _e($data['title'])?>">
        </label>&nbsp;* ex : Status Ym</td>
      </tr>      
	   <tr>
	     <td valign="top">Code HTML</td>
	     <td colspan="2" align="left" valign="top">Preview</td>
      </tr>
	   <tr>
        <td valign="top" width="50%"><textarea name="coder" id="textcode"><?php _e(htmlentities($data['coder']))?></textarea></td>
        <td colspan="2" align="left" valign="top"><iframe id="textcode_preview"></iframe></td>
      </tr>
<?php
}
?>
	  <tr>
        <td colspan="3"><button name="submit" class="primary"><span class="icon pen"></span>Save & Update</button> or <button name="Reset"><span class="icon loop"></span>Reset</button></td>
      </tr>
</table>
</form>
<?php
}
break;
}
?>
</div>


