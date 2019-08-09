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
<link href="iadmin/manage/options/style-opt.css" rel="stylesheet" media="screen" type="text/css" />
<div class="box-head dotted">Options</div>
<div id="box-content">
<?php
global $iw,$db;
$go 	= filter_txt($_GET['go']);
$act	= filter_txt($_GET['act']);
$id		= filter_int($_GET['id']);

$widget = array(
'menu'		=> menu(),
'gadget' 	=> array( gadget() ),
'help_desk' => 'Ganti Opsi / pengaturan pilihan anda dengan mudah'
);
switch($go){
default:
if(isset($_POST['submit'])){
	$web_title 		= filter_txt($_POST['site_title']);
	$web_slogan 	= filter_txt($_POST['site_slogan']);
	$meta_desc 		= filter_txt($_POST['site_desc']);
	$meta_key 		= filter_txt($_POST['site_keys']);
	$admin_email 	= filter_txt($_POST['mail_adress']);
	$timezone 		= filter_txt($_POST['site_time']);
	$datetime_format= filter_txt($_POST['datetime']);
	
	$data = compact('web_title','web_slogan','meta_desc','meta_key','admin_email','timezone','datetime_format');
	set_general($data);
}
?>
<form action="" method="post" enctype="multipart/form-data" name="form1">
  <table width="100%">
    <tbody>
    <tr>
      <td valign="top" width="24%">Site Title</td>
      <td valign="top" width="1%"><strong>:</strong></td>
      <td width="75%"><input type="text" name="site_title" value="<?php _e(get_option('web_title'))?>" style="width:300px;"></td>
    </tr>
    <tr>
      <td valign="top" width="24%">Slogan</td>
      <td valign="top" width="1%"><strong>:</strong></td>
      <td width="75%"><input type="text" name="site_slogan" value="<?php _e(get_option('web_slogan'))?>" style="width:300px;"></td>
    </tr>
    <tr>
      <td valign="top" width="24%">Description</td>
      <td valign="top" width="1%"><strong>:</strong></td>
      <td width="75%">
      <textarea type="text" name="site_desc" style="width:400px; height:60px;"><?php _e(get_option('meta_desc'))?></textarea></td>
    </tr>
    <tr>
      <td valign="top" width="24%">Keywords</td>
      <td valign="top" width="1%"><strong>:</strong></td>
      <td width="75%">
      <textarea type="text" name="site_keys" style="width:400px; height:60px;"><?php _e(get_option('meta_key'))?></textarea></td>
    </tr>
    <tr>
      <td valign="top" width="24%">E-mail address</td>
      <td valign="top" width="1%"><strong>:</strong></td>
      <td width="75%"><input type="text" name="mail_adress" value="<?php _e(get_option('admin_email'))?>" style="width:200px;"></td>
    </tr>
	<?php
    if ( timezone_supported() ) :
    ?>  
    <tr>
      <td valign="top" width="24%">Timezone</td>
      <td valign="top" width="1%"><strong>:</strong></td>
      <td width="75%">
      <select name="site_time">
	<?php
    $tzstring = get_option('timezone');
    echo timezone_choice($tzstring);
	?>
      </select>
	UTC time is <i><?php _e(gmdate('Y-m-d G:i:s'))?></i>
	Local time is <i><?php _e(date('Y-m-d G:i:s'))?></i>
      </td>
    </tr>
    <?php	
    endif;
    ?>
    <tr>
      <td valign="top" width="24%">Datetime format</td>
      <td valign="top" width="1%"><strong>:</strong></td>
      <td width="75%"><input type="text" name="datetime" value="<?php _e(get_option('datetime_format'))?>" style="width:150px;"> *ex: F j, Y, g:i a => March 10, 2001, 5:16 pm</td>
    </tr>
  </tbody></table>
<div class="num" style="text-align: left;">
<button name="submit" class="primary"><span class="icon pen"></span>Save & Update</button> or <button name="Reset"><span class="icon loop"></span>Reset</button>
</div></form>
<?php
break;
case'privacy':
if(isset($_POST['submit'])){
	$author 		= filter_txt($_POST['author']);
	$account 		= filter_int($_POST['account']);
	$web_status 	= filter_int($_POST['site_status']);
	$robots 		= filter_txt($_POST['site_robots']);
	$timeout		= filter_int($_POST['timeout']);
	
	$data = compact('author','account','web_status','robots','timeout');
	set_privacy($data);
}
?>
<form action="" method="post" enctype="multipart/form-data" name="form1">
  <table width="100%">
    <tbody><tr>
      <td valign="top" width="24%">Author Name</td>
      <td valign="top" width="1%"><strong>:</strong></td>
      <td width="75%"><input type="text" name="author" value="<?php _e(get_option('author'))?>"></td>
    </tr>
    <tr>
      <td valign="top" width="24%">Account Registration</td>
      <td valign="top" width="1%"><strong>:</strong></td>
      <td width="75%">
      <select name="account">
      <optgroup label="Select Account">
<?php
if(get_option('account')==1){
	_e('	
      <option value="0">Disable</option>
      <option value="1" selected="selected">Enable</option>
	');
}else{	
	_e('	
      <option value="0" selected="selected">Disable</option>
      <option value="1">Enable</option>
	');
}
?>
	  </optgroup>
      </select>
      </td>
    </tr>
    <tr>
      <td valign="top" width="24%">Web Status</td>
      <td valign="top" width="1%"><strong>:</strong></td>
      <td width="75%">
      <select name="site_status">
      <optgroup label="Select Status">
<?php
if(get_option('web_status')==1){
	_e('	
      <option value="0">Offline</option>
      <option value="1" selected="selected">Online</option>
	');
}else{	
	_e('	
      <option value="0" selected="selected">Offline</option>
      <option value="1">Online</option>
	');
}
?>
	  </optgroup>
      </select>
      </td>
    </tr>
    <tr>
      <td valign="top" width="24%">Robots</td>
      <td valign="top" width="1%"><strong>:</strong></td>
      <td width="75%">
      <textarea type="text" name="site_robots" style="width:300px; height:60px;"><?php _e(get_option('robots'))?></textarea></td>
    </tr>
    <tr>
      <td valign="top" width="24%">Time Out</td>
      <td valign="top" width="1%"><strong>:</strong></td>
      <?php
	  $time   	= get_option('timeout');
	  $minute 	= round(($time/60),2);
	  $hours  	= round(($minute/60),2);
	  $day  	= round(($hours/24),2);
	  $month  	= round(($day/30),2);
	  $year  	= round(($month/12),2);
	  ?>
      <td width="75%"><input type="text" name="timeout" value="<?php _e($time)?>" style="width:50px"> * second => <?php _e($minute)?> minutes => <?php _e($hours)?> hours => <?php _e($day)?> day => <?php _e($month)?> month => <?php _e($year)?> year</td>
    </tr>
  </tbody></table>
<div class="num" style="text-align: left;">
<button name="submit" class="primary"><span class="icon pen"></span>Save & Update</button> or 
<button name="Reset"><span class="icon loop"></span>Reset</button>
</div></form>
<?php
break;
case'setting':
if(isset($_POST['submit'])){
	$copyright 		= filter_txt($_POST['site_copyright']);
	$poweredby 		= filter_txt($_POST['powered_by']);
	$update_system 	= filter_txt($_POST['update_system']);
	$welcom_message = filter_int($_POST['admin_message']);
	
	$data = compact('copyright','poweredby','welcom_message','update_system');
	set_setting($data);
}
?>
<form action="" method="post" enctype="multipart/form-data" name="form1">
  <table width="100%">
    <tbody>
    <tr>
      <td valign="top" width="24%">Admin Message</td>
      <td valign="top" width="1%"><strong>:</strong></td>
      <td width="75%">
      <select name="admin_message">
      <optgroup label="Select Status">
<?php
if(get_option('welcom_message')==1){
	_e('	
      <option value="0">Hidden</option>
      <option value="1" selected="selected">Show</option>
	');
}else{	
	_e('	
      <option value="0" selected="selected">Hidden</option>
      <option value="1">Show</option>
	');
}
?>
	  </optgroup>
      </select>
      </td>
    </tr>
    <tr>
      <td valign="top" width="24%">Copyright</td>
      <td valign="top" width="1%"><strong>:</strong></td>
      <td width="75%"><input type="text" name="site_copyright" value="<?php _e(get_option('copyright'))?>"></td>
    </tr>
    <tr>
      <td valign="top" width="24%">Powered by</td>
      <td valign="top" width="1%"><strong>:</strong></td>
      <td width="75%"><input type="hidden" name="powered_by" value="cmsid"><input disabled="disabled" type="text" name="powered_by" value="<?php _e(get_option('poweredby'))?>"> * not available to edit</td>
    </tr>
    <tr>
      <td valign="top" width="24%">Update System</td>
      <td valign="top" width="1%"><strong>:</strong></td>
      <td width="75%">
      <select name="update_system">
      <optgroup label="Select Option">
<?php
if(get_option('update_system')=='yes'){
	_e('	
      <option value="no">No</option>
      <option value="yes" selected="selected">Yes</option>
	');
}else{	
	_e('	
      <option value="no" selected="selected">No</option>
      <option value="yes">Yes</option>
	');
}
?>
	  </optgroup>
      </select>
      </td>
    </tr>
  </tbody></table>
<div class="num" style="text-align: left;">
<button name="submit" class="primary"><span class="icon pen"></span>Save & Update</button> or 
<button name="Reset"><span class="icon loop"></span>Reset</button>
</div></form>
<?php
break;
case'avatar':
if(isset($_POST['submit'])){
	$avatar_default		= filter_txt($_POST['avatar_default']);
	
	$data = compact('avatar_default');
	set_avatar($data);
}
?>
<form action="" method="post" enctype="multipart/form-data" name="form1">
<?php
$avatar_defaults = array(
	'mystery' 			=> 'Mystery Man',
	'blank' 			=> 'Blank',
	'gravatar_default' 	=> 'Gravatar Logo',
	'identicon' 		=> 'Identicon (Generated)',
	'wavatar' 			=> 'Wavatar (Generated)',
	'monsterid' 		=> 'MonsterID (Generated)',
	'retro' 			=> 'Retro (Generated)'
);
$default = get_option('avatar_default');
if ( empty($default) )
$default 		= 'mystery';

foreach ( $avatar_defaults as $default_key => $default_name ) {
	$selected = ($default == $default_key) ? 'checked="checked" ' : '';
	$avatar_list .= "";

	$avatar = get_gravatar( 'unknow@mail.com', $default_key );
	$avatar_img = '';

	$avatar_name= $default_name;
}

?>
<table id=table cellpadding="0" cellspacing="0" width="100%">
<tr class="head">
    <td colspan="3">Default Gravatar</td>
  </tr>
<tr class="head">
    <td width="3%" style="text-align:left;border-top:0"><strong>List</strong></td>
    <td width="7%" style="text-align:center;border-top:0"><strong>Image</strong></td>
    <td width="90%" style="text-align:left;border-top:0"><strong>Title</strong></td>
  </tr>
<?php
$warna 		= '';
foreach ( $avatar_defaults as $default_key => $default_name ) {
	
$warna 		= empty ($warna) ? ' bgcolor="#f1f6fe"' : '';
$selected 	= ($default == $default_key) ? 'checked="checked" ' : '';
$avatar 	= get_gravatar( 'unknow@mail.com', $default_key );
?>
  <tr <?php _e($warna)?> class="isi">
    <td>
	<?php _e("<input type='radio' name='avatar_default' id='avatar_{$default_key}' value='" . esc_sql($default_key)  . "' {$selected}/>")?>
    </td>
    <td align="center"><img src="<?php _e($avatar)?>" alt="" width="30"/></td>
    <td><?php _e($default_name)?></td>
  </tr>
<?php
}
?>
</table>
<div class="num" style="text-align: left;">
<button name="submit" class="primary"><span class="icon pen"></span>Save & Update</button> or 
<button name="Reset"><span class="icon loop"></span>Reset</button>
</div></form>
<?php
break;

case'quick-links':
if($act=='add'):
if(isset($_POST['submit'])){
	$title 		= filter_txt($_POST['title']);
	$type 		= filter_int($_POST['type']);
	$url 		= filter_txt($_POST['url']);
	
	$data = compact('title','type','url');
	set_quick_links($data);
}
?>
<form action="" method="post" enctype="multipart/form-data" name="form1">
  <table width="100%">
    <tbody>
    <tr>
      <td valign="top" width="24%">Type</td>
      <td valign="top" width="1%"><strong>:</strong></td>
      <td width="75%">
      <select name="type">
        <option value="">Pilih Manager</option>
        <option value="1">Sys</option>
        <option value="2">App</option>
        <option value="3">Plg</option>
      </select>
      </td>
    </tr>
    <tr>
      <td valign="top" width="24%">Title</td>
      <td valign="top" width="1%"><strong>:</strong></td>
      <td width="75%"><input type="text" name="title"></td>
    </tr>
    <tr>
      <td valign="top" width="24%">Link path</td>
      <td valign="top" width="1%"><strong>:</strong></td>
      <td width="75%"><input type="text" name="url"> * ex: links</td>
    </tr>
  </tbody></table>
<div class="num" style="text-align: left;">
<button name="submit" class="primary"><span class="icon pen"></span>Add</button> or 
<button name="Reset"><span class="icon loop"></span>Reset</button>
</div></form>
<?php
elseif($act=='del'):
del_quick_links($id);
else:
if(isset($_POST['submit'])){
	$title = esc_sql($_POST['data1']);
	$type  = esc_sql($_POST['data2']);
	$url   = esc_sql($_POST['data3']);
	
	$data  = compact('title','type','url');
	update_qlink_options($data);
}

$QpA 	= get_option('qlinks');
$QpB 	= explode('#',$QpA);
$QpC 	= count($QpB)-1;
?>
<div class="num" style="text-align:left">
<a href="?admin&sys=options&go=quick-links&act=add" class="button"><strong>&nbsp;+&nbsp;</strong></a> Tambahkan beberapa link
</div>
<form action="" method="post">
<div id="list-comment">
<div class="mash-div"></div>
<table border="0" cellspacing="0" cellpadding="0" id="table">
  <tr class="head">
    <td class="depan" width="2%"><center><strong>No</strong></center></td>
    <td class="depan"><strong>Title</strong></td>
    <td class="depan"><center><strong>Type</strong></center></td>
    <td class="depan"><strong>Url Path</strong></td>
    <td class="depan"><center><strong>Action</strong></center></td>
  </tr>
<?php
$panel 	= array();
$warna  = '';
foreach($QpB as $key=>$val){
$QpD 	= explode('::',$val);
$warna  = empty ($warna) ? ' bgcolor="#f1f6fe"' : '';
?>
  <tr <?php _e($warna)?> class="isi">
    <td><center><?php _e($key+1)?></center></td>
    <td><input type="text" name="data1[]" value="<?php _e($QpD[0])?>"></td>
    <td><center>
    <select name="data2[]" style="float:left;">
	<?php 
    if($QpD[1]==1){?>
    <option value="1" selected="selected">Sys</option>
    <option value="2">App</option>
    <option value="3">Plg</option>
    <?php }elseif($QpD[1]==2){?>
    <option value="1">Sys</option>
    <option value="2" selected="selected">App</option>
    <option value="3">Plg</option>
    <?php }elseif($QpD[1]==3){?>
    <option value="1">Sys</option>
    <option value="2">App</option>
    <option value="3" selected="selected">Plg</option>
    <?php }else{?>
    <option value="">Pilih</option>
    <option value="1">Sys</option>
    <option value="2">App</option>
    <option value="3">Plg</option>
    <?php }?>
    </select></center>
    </td>
    <td><input type="text" name="data3[]" value="<?php _e($QpD[2])?>" style="width:230px;"></td>
    <td><center><a href="?admin&sys=options&go=quick-links&act=del&id=<?php _e($key)?>" class="delete" title="delete" onclick="return confirm('Are You sure delete this quick links?')">delete</a></center></td>
  </tr>
<?php
}
?>

  <tr class="head">
    <td class="depan" width="2%" style="border-top:0;"><center><strong>No</strong></center></td>
    <td class="depan" style="border-top:0;"><strong>Title</strong></td>
    <td class="depan" style="border-top:0;"><center><strong>Type</strong></center></td>
    <td class="depan" style="border-top:0;"><strong>Url Path</strong></td>
    <td class="depan" style="border-top:0;"><center><strong>Action</strong></center></td>
  </tr>
</table>
</div>
<div class=num style="text-align:left;">
<button name="submit" class="primary"><span class="icon pen"></span>Save & Update</button> or 
<button name="Reset"><span class="icon loop"></span>Reset</button></div>
</form>
<?php
endif;
break;
}
?>
</div>


