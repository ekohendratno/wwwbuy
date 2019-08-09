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

<div class="box-head dotted">Media Manager</div>
<div id="box-content">
<?php
global $iw,$db,$icon_id;
$go 	= filter_txt($_GET['go']);
$act	= filter_txt($_GET['act']);
$path 	= filter_txt($_GET['path']);
$path 	= decode($path);

$widget = array(
'menu'		=> menu(),
'gadget' 	=> array( gadget1(), gadget2($max_space, $dir_levels), gadget3() ),
'help_desk' => 'Memungkinkan anda mengganti style atau tampilan website front end anda'
);

$kataloog			= '.';
$icon_id 			= array("asp", "avi", "bmp", "chm", "css", "doc", "exe", "gif", "gz", "htm", "html", "jpg", "jpeg", "js", "jsp", "mov", "mp3", "mpeg", "mpg", "pdf", "php", "png", "ppt", "rar", "sql", "txt", "wav", "wmv", "xls", "xml", "xsl", "zip");
$file_allaw 		= array("icon_id");
$file_not_allaw 	= array(".ftpquota");
$file_allaw_edit 	= array("php", "css", "xml", "txt", "sql", "asp", "htm", "html", "js", "jsp");
$max_space 			= 25600;
$dir_levels 		= 1;
$islinux 			= !(strtoupper(substr(PHP_OS, 0, 3)) === 'WIN');

switch($go){
default:
if(isset($act) && !empty($act)){
	if($act=='del'){
		del_folder_file($path);
	}
}

?>
Path:
<?php

_e($path);

if(!$path) 
	$path = $kataloog;
else
{
	//
	// Selline vormistus on keelatud
	//
	if(ereg("\.\.(.*)", $path) || $path[0] == '/')
	{
		$path = $kataloog;
		$path_dir = "";
	}
	else
	{
		$path = $path;
		$path_dir = mine_kataloog($path);
	}
}

if($open = @opendir($path)){
$i = 0;
while ($file = readdir($open)){
	if($file != "." && $file != ".."){
		if(is_dir($path."/".$file)){
					
		if(!in_array($file, $file_allaw))
		$folder[$i]["dir_name"]  	= htmlspecialchars($file);
		$folder[$i]["perms"] 		= perms(fileperms($path."/".$file));
			$i++;
		
		}else if(!in_array($file, $file_not_allaw)){
			$file_id[$i]["file_name"] 	= htmlspecialchars($file);
			$file 					= $path."/".$file;
			$file_id[$i]["ext"]     = file_end($file);
			$file_id[$i]["size"]    = filesize($file);
			$file_id[$i]["date"]	= filemtime($file);
			$file_id[$i]["perms"]	= perms(fileperms($file));
			$i++;
		}

	}
}
closedir($open);
}
?>
<table width=100% id='table' cellpadding='0' cellspacing='0'>
<tr class='head'>
<td width="52%" style="text-align:left;">Folder & File</td>
<td width="6%" style="text-align:center">Permission</td>
<td width="2%" style="text-align:left">Size</td>
<td width="40%" style="text-align:center;">Action</td>
</tr>
<tr class="head2">
<td style="text-align:left; width:65%;border-top:0;"><a href="?admin&sys=media&path=<?php _e( encode($path_dir) );?>"><img src="iadmin/manage/media/images/folder-mac.png"> Up</a></td>
<td></td>
<td></td>
<td></td>
</tr>
<?php
if($folder){
	foreach ($folder as $is_folder){
?>
<tr class=isi>
<td><a href='?admin&sys=media&path=<?php _e( encode($path.'/'.$is_folder['dir_name']) ); ?>'>
<img src='iadmin/manage/media/images/folder-mac.png'>
<?php _e($is_folder['dir_name'])?></a></td>
<td align="center">
<?php _e($is_folder['perms']);?>
</td>
<td></td>
<td align="right">
<a href="?admin&sys=media&go=rename&path=<?php _e( encode($path.'/'.$is_folder['dir_name']) )?>" title='Rename'><img src='iadmin/manage/media/images/ren.gif'></a>
<a href="?admin&sys=media&go=chmod&path=<?php _e( encode($path.'/'.$is_folder['dir_name']) )?>" title='CHMOD'><img src='iadmin/manage/media/images/chmod.gif'></a>
<a href="?admin&sys=media&act=del&path=<?php _e( encode($path.'/'.$is_folder['dir_name']) )?>" onclick="return confirm('Are You sure delete folder <?php _e($is_folder['dir_name'])?>')"><img src='iadmin/manage/media/images/del.gif'></a>
</td>
</tr>
<?php
	}
}
if($file_id){
	foreach ($file_id as $is_file){
?>
<tr class="isi">
<td><img src='<?php _e(file_icon( $is_file['ext'] ))?>'><?php _e($is_file['file_name'])?>
</td>
<td align="center"><?php _e($is_file['perms'])?></td>
<td align="right"><?php _e(file_size( $is_file['size'] ))?></td>
<td align="right">
<?php
if(in_array($is_file['ext'],$file_allaw_edit)){
_e('<a href="?admin&sys=media&go=editor&path='.encode($path.'/'.$is_file['file_name']).'" title="Edit"><img src="iadmin/manage/media/images/edit.gif"></a>');
}
?>
<a href="?admin&sys=media&go=rename&path=<?php _e( encode($path.'/'.$is_file['file_name']) ); ?>" title='Rename'>
<img src='iadmin/manage/media/images/ren.gif'></a>
<a href="?admin&sys=media&go=chmod&path=<?php _e( encode($path.'/'.$is_file['file_name']) ); ?>" title='CHMOD'>
<img src='iadmin/manage/media/images/chmod.gif'></a>
<a href="?admin&sys=media&act=del&path=<?php _e( encode($path.'/'.$is_file['file_name']) ); ?>" title='Delete'  onclick="return confirm('Are You sure delete file <?php _e($is_file['file_name']); ?>?')">
<img src='iadmin/manage/media/images/del.gif'></a> 
</td>
</tr>
<?php
	}
}
?>
</table>
<div class=num style="height:24px;">
<div class="right">
<a href="?admin&sys=media&go=uploader&path=<?php _e( encode($path) ); ?>" class="xleft button"><span class="icon uparrow"></span>Uploader</a>
<a href="?admin&sys=media&go=add&path=<?php _e( encode($path) ); ?>" class="xright button"><span class="icon plus"></span>Add</a>
</div>
</div>

<?php
break;
case'editor':
$widget = array(
'menu'		=> menu(),
'help_desk' => 'Memungkinkan anda melakukan coding style dengan mudah'
);

if (isset($_POST['submit'])) {
	$file = $_POST['file'];
	save_to_file($file);
}
?>
<div class=num style="text-align:left"><?php _e( get_file_name($path) )?></div>
<form action="" method="post" enctype="multipart/form-data" name="form1">
<input type="hidden" name="file" value="<?php _e($path)?>">
<textarea id="textcode" name="content">
<?php _e(htmlspecialchars(file_get_contents( $path )))?>
</textarea>
<div class=num style="text-align:left;">
<button name="submit" class="primary"><span class="icon pen"></span>Save & Update</button> or <button name="Reset"><span class="icon loop"></span>Reset</button>
</div>
</form>
<?php
break;
case'add':
if(isset($_POST['submit'])){
	$name_folder	= filter_txt($_POST['name_folder']);
	$html_template	= filter_int($_POST['html_template']);
	$path			= filter_txt($_POST['path']);
	
	$data = compact('name_folder','name_file','html_template','path');
	make_dir_file($data);
}
?>
<form action="" method="post">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td>Name Folder</td>
      <td><strong>:</strong></td>
      <td><input type="text" name="name_folder"></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td><input type="checkbox" name="html_template" id="checkbox" value="1"/><label for="checkbox">(include file index.php)</label></td>
    </tr>
    <tr>
      <td width="13%">Path</td>
      <td width="1%"><strong>:</strong></td>
      <td width="86%"><input type="text" name="path" value="<?php echo $path;?>" style="width:300px;"></td>
    </tr>
    <tr>
      <td>Date create</td>
      <td><strong>:</strong></td>
      <td><?php _e( datetimes( date('Y-m-d H:i:s') ) )?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>
<button name="submit" class="primary"><span class="icon plus"></span>Add</button> or <button name="Reset"><span class="icon loop"></span>Reset</button></td>
    </tr>
  </table>
</form>
<?php
break;
case'chmod':
if(isset($_POST['submit'])){
	$path_change= filter_txt($_POST['path']);
	$permission	= filter_int($_POST['permission']);
	set_permission($path_change,$permission);
}
?>
<form action="" method="post" name="chmod">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="13%" valign="top">Path</td>
      <td width="1%" valign="top"><strong>:</strong></td>
      <td width="86%"><textarea name="path" style="width:400px"><?php echo $path;?></textarea></td>
    </tr>
    <tr>
      <td valign="top">Set Permission</td>
      <td valign="top"><strong>:</strong></td>
      <td>
<script type="text/javascript">
<!--

function octalchange() 
{
	var val = document.chmod.permission.value;
	var ownerbin = parseInt(val.charAt(0)).toString(2);
	while (ownerbin.length<3) { ownerbin="0"+ownerbin; };
	var groupbin = parseInt(val.charAt(1)).toString(2);
	while (groupbin.length<3) { groupbin="0"+groupbin; };
	var otherbin = parseInt(val.charAt(2)).toString(2);
	while (otherbin.length<3) { otherbin="0"+otherbin; };
	document.chmod.owner4.checked = parseInt(ownerbin.charAt(0)); 
	document.chmod.owner2.checked = parseInt(ownerbin.charAt(1));
	document.chmod.owner1.checked = parseInt(ownerbin.charAt(2));
	document.chmod.group4.checked = parseInt(groupbin.charAt(0)); 
	document.chmod.group2.checked = parseInt(groupbin.charAt(1));
	document.chmod.group1.checked = parseInt(groupbin.charAt(2));
	document.chmod.other4.checked = parseInt(otherbin.charAt(0)); 
	document.chmod.other2.checked = parseInt(otherbin.charAt(1));
	document.chmod.other1.checked = parseInt(otherbin.charAt(2));
	calc_chmod(1);
};

function calc_chmod(nototals)
{
  var users = new Array("owner", "group", "other");
  var totals = new Array("","","");
  var syms = new Array("","","");

	for (var i=0; i<users.length; i++)
	{
	  var user=users[i];
		var field4 = user + "4";
		var field2 = user + "2";
		var field1 = user + "1";
		//var total = "t_" + user;
		var symbolic = "sym_" + user;
		var number = 0;
		var sym_string = "";
	
		if (document.chmod[field4].checked == true) { number += 4; }
		if (document.chmod[field2].checked == true) { number += 2; }
		if (document.chmod[field1].checked == true) { number += 1; }
	
		if (document.chmod[field4].checked == true) {
			sym_string += "r";
		} else {
			sym_string += "-";
		}
		if (document.chmod[field2].checked == true) {
			sym_string += "w";
		} else {
			sym_string += "-";
		}
		if (document.chmod[field1].checked == true) {
			sym_string += "x";
		} else {
			sym_string += "-";
		}
	
		//if (number == 0) { number = ""; }
	  //document.chmod[total].value = 
		totals[i] = totals[i]+number;
		syms[i] =  syms[i]+sym_string;
	
  };
	if (!nototals) document.chmod.permission.value = totals[0] + totals[1] + totals[2];
	document.chmod.sym_total.value = "-" + syms[0] + syms[1] + syms[2];
}
window.onload=octalchange
//-->
</script> 
<table cellpadding="2" cellspacing="0" border="0" style="font:normal 12px Verdana; border:1px solid #dcdcdc; padding:2px;">
<tbody><tr bgcolor="#dcdcdc">
<td width="60" align="left"> </td>
<td width="55" align="center" style="color:black"><b>owner
</b></td>
<td width="55" align="center" style="color:black"><b>group
</b></td>
<td width="55" align="center" style="color:black"><b>other
<b></b></b></td>
</tr>
<tr bgcolor="#dddddd">
<td width="60" nowrap="" bgcolor="#fff">read</td>
<td width="55" align="center" bgcolor="#EEEEEE">
<input type="checkbox" name="owner4" value="4" onclick="calc_chmod()">
</td>
<td width="55" align="center" bgcolor="#ffffff"><input type="checkbox" name="group4" value="4" onclick="calc_chmod()">
</td>
<td width="55" align="center" bgcolor="#EEEEEE">
<input type="checkbox" name="other4" value="4" onclick="calc_chmod()">
</td>
</tr>
<tr bgcolor="#dddddd">		
<td width="60" nowrap="" bgcolor="#fff">write</td>
<td width="55" align="center" bgcolor="#EEEEEE">
<input type="checkbox" name="owner2" value="2" onclick="calc_chmod()"></td>
<td width="55" align="center" bgcolor="#ffffff"><input type="checkbox" name="group2" value="2" onclick="calc_chmod()">
</td>
<td width="55" align="center" bgcolor="#EEEEEE">
<input type="checkbox" name="other2" value="2" onclick="calc_chmod()">
</td>
</tr>
<tr bgcolor="#dddddd">		
<td width="60" nowrap="" bgcolor="#fff">execute</td>
<td width="55" align="center" bgcolor="#EEEEEE">
<input type="checkbox" name="owner1" value="1" onclick="calc_chmod()">
</td>
<td width="55" align="center" bgcolor="#ffffff"><input type="checkbox" name="group1" value="1" onclick="calc_chmod()">
</td>
<td width="55" align="center" bgcolor="#EEEEEE">
<input type="checkbox" name="other1" value="1" onclick="calc_chmod()">
</td>
</tr>
</tbody></table> 

      </td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td><input type="text" name="permission" style="width:30px;" onkeyup="octalchange()"><input type="text" name="sym_total" value="" size="12" readonly="1" style="border: 0px none; font-family: &quot;Courier New&quot;, Courier, mono;"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>
<button name="submit" class="primary"><span class="icon pen"></span>Change</button> or <button name="Reset"><span class="icon loop"></span>Reset</button></td>
    </tr>
  </table>
</form>
<?php
break;
case'rename':
if(isset($_POST['submit'])){
	$old= filter_txt($_POST['old']);
	$new= filter_txt($_POST['new']);
	set_rename($old,$new);
}
?>
<form action="" method="post" name="chmod">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td>Name</td>
      <td><strong>:</strong></td>
      <td><input type="text" name="new" style="width:400px" value="<?php _e($path)?>"><input type="hidden" name="old" value="<?php _e($path)?>"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>
<button name="submit" class="primary"><span class="icon pen"></span>Rename</button> or <button name="Reset"><span class="icon loop"></span>Reset</button></td>
    </tr>
  </table>
</form>
<?php
break;
case'uploader':

if(isset($_POST['submit'])){
	$myfile 	= $_FILES['myfile'];
	$uploadDir 	= abs_path.$path.'/';
	
	$data 		= compact('myfile','uploadDir');
	
	if(function_exists('uploader'))
	if( uploader($data) ){
		_e('<meta http-equiv="refresh" content="0.3; url=?admin&sys=media&path='.encode($path).'" />');
	}
}
?>
<form action="" method="post" enctype="multipart/form-data">
<input type="file" name="myfile"><br>
<button name="submit">Upload</button>
</form>
<?php
break;
}
?>
</div>


