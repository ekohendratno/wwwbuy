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
<link href="iadmin/manage/users/style-users.css" rel="stylesheet" media="screen" type="text/css" />
<div class="box-head dotted">Users Manager</div>
<div id="box-content">
<?php
global $iw,$db,$access,$session;
$go 	= filter_txt($_GET['go']);
$act	= filter_txt($_GET['act']);
$to		= filter_txt($_GET['to']);
$offset	= filter_int($_GET['offset']);
$id  	= filter_txt($_GET['id']);

$obj 	= country();
$widget = array(
'menu'		=> menu(),
'gadget'	=> array( gadget(), gadget2() ),
'help_desk' => 'tool ini mempermudah anda memanage user atau akun website'
);

switch($go){
default:
if($act == 'del' && !empty($act)){
	del_users($id); 
}
if(isset($offset) && !empty($offset)) $limit = $offset;
else $limit	= 10;
$a			= new paging_admin();
$q			= $a->query('SELECT * FROM '.$iw->pre.'users ORDER BY user_registered DESC', $limit);
$warna 		= '';
echo js_redirec_list();
$selected	='';
if($offset==10){$sel1='selected="selected"';}
if($offset==30){$sel2='selected="selected"';}
if($offset==50){$sel3='selected="selected"';}
?>
<div class=num style="text-align:left">
Show :
<select onchange="redir(this)" name="show">
<option value="?admin&sys=users&offset=10" <?php _e($sel1)?>>10</option>
<option value="?admin&sys=users&offset=30" <?php _e($sel2)?>>30</option>
<option value="?admin&sys=users&offset=50" <?php _e($sel3)?>>50</option>
</select>
<div class="right"><a href="?admin&sys=users&go=add" class="button"><span class="icon plus"></span>Add</a></div>
</div>
<div id="list-comment">
<div class="mash-div"></div>
<?php
while($row = $db->fetch_assoc($q)){
$warna  = empty ($warna) ? 'style="background:#f1f6fe;"' : '';
?>
<div class="comment" <?php _e($warna)?>>
<img alt="" src="<?php _e( get_gravatar($row['user_email']))?>" class="avatar" height="50" width="50">
<div class="dashboard-comment-wrap">
<span class="name"><?php _e( uc_first($row['user_login']) )?></span><br />
Negara <span class="country"><em>
<?php if(empty($row['user_country'])){
	_e('unknow');
}else{
	_e($obj->CountryName($row['user_country']));
}
?></em></span> 
Province <span class="prov"><em>
<?php if(empty($row['user_province'])){
	_e('unknow');
}else{
	_e($row['user_province']);
}
?></em></span> 
<br />Date <span class="date"><em><?php _e( datetimes($row['user_registered']) )?></em></span>				
<p class="row-actions">
<span class="edit"><a href="?admin&sys=users&go=edit&to=data&id=<?php _e( $row['ID'] )?>">Edit Data</a></span>
<span class="edit"> | <a href="?admin&sys=users&go=edit&to=pass&id=<?php _e( $row['ID'] )?>">Edit Password</a></span>
<span class="trash"> | <a href="?admin&sys=users&act=del&id=<?php _e( $row['ID'] )?>"  onclick="return confirm('Are You sure delete this users?')">Trash</a></span>
</p>
</div>
</div>
<?php
}
?>
</div>
<!--halaman navigasi-->
<div id="num">
<?php _e($a->pg('?admin&sys=users&offset='.$offset));?>
</div>
<?php
break;
case'add':
if (isset($_POST['submit'])){
	$username	= filter_txt($_POST['username']);
	$email		= filter_txt($_POST['email']);
	$author		= filter_txt($_POST['author']);
	$sex		= filter_int($_POST['sex']);
	$newpass	= filter_txt($_POST['newpass']);
	$repass		= filter_txt($_POST['repass']);
	$level		= filter_txt($_POST['level']);
	$status		= filter_int($_POST['status']);
	$country	= filter_txt($_POST['country']);
	
	if( empty( $newpass ) || empty( $repass ) ){ 
		$msg[] = '<strong>ERROR</strong>: The password is empty.';
	}else{ 
		$newpass= md5($newpass);
		$repass = md5($repass);
		if( $newpass !== $repass) $msg[] = '<strong>ERROR</strong>: The password not match.';
		else $pass = esc_sql($newpass);
	}
	
	if( empty($author) ) $msg[] = '<strong>ERROR</strong>: The author name empty.'; 
	if( empty($level) )  $msg[] = '<strong>ERROR</strong>: The level field not select.'; 
	if( empty($status) ) $msg[] = '<strong>ERROR</strong>: The status field not select.'; 
		
	if( is_array($msg))	{
	foreach($msg as $val){
		_e('<div id="error">'.$val.' </div>');
	}}
	
	if(empty($msg)):
	$userdata	= compact('username','email','sex','author');
	$more		= compact('user_status','sex','status','pass','level','country');
	$access->create_user($userdata,$more);
	endif;
}
?>
<form name="form1" method="post" action="">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="27%" align="right"> User Name </td>
      <td width="1%"><strong>:</strong></td>
      <td width="72%" align="left">
      <input type="text" name="username" value=""></td>
    </tr>
    <tr>
      <td width="27%" align="right"> E-Mail </td>
      <td width="1%"><strong>:</strong></td>
      <td width="72%" align="left">
      <input type="text" name="email" value=""></td>
    </tr>
    <tr>
      <td width="27%" align="right"> Author Name </td>
      <td width="1%"><strong>:</strong></td>
      <td width="72%" align="left">
      <input type="text" name="author" value=""></td>
    </tr>
    <tr>
      <td align="right">Seorang </td>
      <td><strong>:</strong></td>
      <td align="left"><select name="sex">
        <option value="0" selected="selected">Pilih Jenis kelamin</option>
        <option value="1">Perempuan</option>
        <option value="2">Laki laki</option>
      </select></td>
    </tr>
    <tr>
      <td width="27%" align="right"> New Password </td>
      <td width="1%"><strong>:</strong></td>
      <td width="72%" align="left">
      <input type="password" name="newpass" value=""></td>
    </tr>
    <tr>
      <td width="27%" align="right"> Retry Password </td>
      <td width="1%"><strong>:</strong></td>
      <td width="72%" align="left">
      <input type="password" name="repass" value=""></td>
    </tr>
    <tr>
      <td align="right">Level </td>
      <td><strong>:</strong></td>
      <td align="left"><select name="level">
        <option value="" selected="selected">Pilih Level Access</option>
        <option value="user">User</option>
        <option value="admin">Admin</option>
      </select></td>
    </tr>
    <tr>
      <td align="right">Status </td>
      <td><strong>:</strong></td>
      <td align="left"><select name="status">
        <option value="0" selected="selected">Pilih Status User</option>
        <option value="1">Inactive</option>
        <option value="2">Active</option>
      </select></td>
    </tr>
    <tr>
      <td align="right">Country </td>
      <td><strong>:</strong></td>
      <td align="left"><select name="country">
      <?php
	  $obj->CountryList();
	  ?>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td align="left"><button name="submit" class="primary"><span class="icon plus"></span>Add</button> or <button name="Reset"><span class="icon loop"></span>Reset</button></td>
    </tr>
  </table>
</form>
<?php
break;
case'edit':

if($to == 'data'){

if (isset($_POST['submit'])){
	$username	= filter_txt($_POST['username']);
	$email		= filter_txt($_POST['email']);
	$author		= filter_txt($_POST['author']);
	$sex		= filter_int($_POST['sex']);
	$level		= filter_txt($_POST['level']);
	$status		= filter_int($_POST['status']);
	$country	= filter_txt($_POST['country']);
	$province	= filter_txt($_POST['province']);
	
	if( empty($level) ) $msg[] = '<strong>ERROR</strong>: The level field not select.'; 
	if( empty($status) ) $msg[] = '<strong>ERROR</strong>: The status field not select.'; 
	
	if( is_array($msg))	{
	foreach($msg as $val){
		_e('<div id="error">'.$val.' </div>');
	}}
	if(empty($msg)){
	$userdata	= compact('username','email','sex','author')+array('user_id' => $id);
	$more		= compact('status','level','country','province');
	$access->update_user($userdata,$more);
	}
}
$q	= $db->select("users",array('ID' => $id));
$r  = $db->fetch_array($q);
?>
<form name="form1" method="post" action="">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="27%" align="right"> User Name </td>
      <td width="1%"><strong>:</strong></td>
      <td width="72%" align="left">
      <input type="text" name="username" value="<?php _e($r['user_login'])?>" style="width:150px;">
      </td>
    </tr>
    <tr>
      <td width="27%" align="right"> E-Mail </td>
      <td width="1%"><strong>:</strong></td>
      <td width="72%" align="left">
      <input type="text" name="email" value="<?php _e($r['user_email'])?>" style="width:150px;"></td>
    </tr>
    <tr>
      <td width="27%" align="right"> Author Name </td>
      <td width="1%"><strong>:</strong></td>
      <td width="72%" align="left">
      <input type="text" name="author" value="<?php _e($r['user_author'])?>" style="width:150px;"></td>
    </tr>
    <tr>
      <td align="right">Seorang </td>
      <td><strong>:</strong></td>
      <td align="left"><select name="sex">
      <?php
	  $sex = $r['user_sex'];
	  if($sex==0):
	  ?>
        <option value="0">Pilih Jenis kelamin</option>
        <option value="1" selected="selected">Perempuan</option>
        <option value="2">Laki laki</option>
      <?php
	  elseif($sex==1):
	  ?>
        <option value="0">Pilih Jenis kelamin</option>
        <option value="1">Perempuan</option>
        <option value="2" selected="selected">Laki laki</option>
      <?php
	  else:
	  ?>
        <option value="0" selected="selected">Pilih Jenis kelamin</option>
        <option value="1">Perempuan</option>
        <option value="2">Laki laki</option>
      <?php
	  endif;
	  ?>
      </select></td>
    </tr>
    <tr>
      <td align="right">Level </td>
      <td><strong>:</strong></td>
      <td align="left"><select name="level">
      <?php
	  $level = (string)$r['user_level'];
	  if($level=='user'):
	  ?>
        <option value="">Pilih Level Access</option>
        <option value="user" selected="selected">User</option>
        <option value="admin">Admin</option>
      <?php
	  elseif($level=='admin'):
	  ?>
        <option value="">Pilih Level Access</option>
        <option value="user">User</option>
        <option value="admin" selected="selected">Admin</option>
      <?php
	  else:
	  ?>
        <option value="" selected="selected">Pilih Level Access</option>
        <option value="user">User</option>
        <option value="admin">Admin</option>
      <?php
	  endif;
	  ?>
      </select></td>
    </tr>
    <tr>
      <td align="right">Status </td>
      <td><strong>:</strong></td>
      <td align="left"><select name="status">
      <?php
	  $status = (int)$r['user_status'];
	  if($status==0):
	  ?>
        <option value="0">Pilih Status User</option>
        <option value="1" selected="selected">Inactive</option>
        <option value="2">Active</option>
      <?php
	  elseif($status==1):
	  ?>
        <option value="0">Pilih Status User</option>
        <option value="1">Inactive</option>
        <option value="2" selected="selected">Active</option>
      <?php
	  else:
	  ?>
        <option value="0" selected="selected">Pilih Status User</option>
        <option value="1">Inactive</option>
        <option value="2">Active</option>
      <?php
	  endif;
	  ?>
      </select></td>
    </tr>
    <tr>
      <td align="right">Country </td>
      <td><strong>:</strong></td>
      <td align="left"><select name="country">
      <?php
	  $obj->CountryList($r['user_country']);
	  ?>
      </select></td>
    </tr>
    <tr>
      <td width="27%" align="right"> Province </td>
      <td width="1%"><strong>:</strong></td>
      <td width="72%" align="left">
      <input type="text" name="province" value="<?php _e($r['user_province'])?>" style="width:300px;"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td align="left"><button name="submit" class="primary"><span class="icon pen"></span>Save & Update</button> or <button name="Reset"><span class="icon loop"></span>Reset</button></td>
    </tr>
  </table>
</form>
<?php
}elseif($to == 'pass'){
	
if (isset($_POST['submit'])){
	$oldpass	= filter_txt($_POST['oldpass']);
	$newpass	= filter_txt($_POST['newpass']);
	$repass		= filter_txt($_POST['repass']);
	
	$data = compact('username','oldpass','newpass','repass') + array('user_id' => $id);
	change_password($data);
}
$q	= $db->select('users',array('ID' => $id));
$r  = $db->fetch_array($q);
?>
<form name="form1" method="post" action="">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="27%" align="right"> Old Password </td>
      <td width="1%"><strong>:</strong></td>
      <td width="72%" align="left">
      <input type="password" name="oldpass" value="" style="width:150px;"></td>
    </tr>
    <tr>
      <td width="27%" align="right"> New Password </td>
      <td width="1%"><strong>:</strong></td>
      <td width="72%" align="left">
      <input type="password" name="newpass" value="" style="width:150px;"></td>
    </tr>
    <tr>
      <td width="27%" align="right"> Re Password </td>
      <td width="1%"><strong>:</strong></td>
      <td width="72%" align="left">
      <input type="password" name="repass" value="" style="width:150px;"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td align="left"><button name="submit" class="primary"><span class="icon pen"></span>Save & Update</button> or <button name="Reset"><span class="icon loop"></span>Reset</button></td>
    </tr>
  </table>
</form>
<?php
}else{
	redirect('?admin&sys=users');
}
break;
}
?>
</div>


