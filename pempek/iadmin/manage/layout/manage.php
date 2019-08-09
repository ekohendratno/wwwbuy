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
<link href="iadmin/manage/layout/style-users.css" rel="stylesheet" media="screen" type="text/css" />
<div class="box-head dotted">Layout</div>
<div id="box-content">
<?php
global $iw,$db;
$go 	= filter_txt($_GET['go']);
$act	= filter_txt($_GET['act']);
$name	= filter_txt($_GET['name']);

$widget = array(
'menu'		=> menu(),
'gadget' 	=> array( gadget() ),
'help_desk' => 'Memungkinkan anda mengganti style atau tampilan website front end anda'
);
switch($go){
default:
if(isset($act) && !empty($act)){
if($act == 'active'){
	if (!set_option('template',$name)) echo "<div id='success'>Memasang Theme berhasil.</div>";
	else echo "<div id='error'>Memasang Theme gagal.</div>";
}
if($act == 'delete'){
}}
?>
<h1>Curent Theme</h1><div style="border-top:1px solid #eeeeee; margin-bottom:60px;">
<?php load_style_info(get_option('template').'/');?>
</div><div style="clear:bolth"></div>
<h1>Available theme</h1><div style="border-bottom:1px solid #eeeeee"></div>
<?php
$count=0;$i=0;
unset($theme_arr);
if ($handle = opendir(Thm)) {
	while (false !== ($file = readdir($handle))) {
	$i++;
	if ($file != "." && $file != "..") {
	if (is_dir(Thm.$file)) {
	if ($file."/"!=''.get_option('template').'') $theme_arr[]=$file;
	}}}
	closedir($handle);
}
if (@count($theme_arr)>1){
	foreach($theme_arr as $file){
	$count++;
	if($file!==get_option('template')) {
	load_style_info($dir,$file);
?>
	<div style="padding:4px;margin-left:5px;">
	<a href="?admin&sys=layout&act=active&name=<?php _e($file)?>" onclick="return confirm('Are You sure active this template?')">Active</a> &bull; 
	<a href="?admin&sys=layout&act=delete&name=<?php _e($file)?>" onclick="return confirm('Are You sure delete this template?')">Delete</a></div>
<?php }}}else{?>
	<p>Theme not available</p>
<?php 
} 
?>
<?php
break;
case'preview':
break;
case'editor':
$widget = array(
'menu'		=> menu(),
'help_desk' => 'Memungkinkan anda melakukan coding style dengan mudah'
);

$count=0;$i=0;
unset($theme_arr);
$rep=opendir(Thm . get_option('template'));
while ($file = readdir($rep)) {
	if($file != '..' && $file !='.' && $file !=''){
	if($file !='favicon.ico' && $file !='screenshot.gif' && $file !='images'){
	if(!is_dir($file)){
		$theme_arr[]=$file;
	}
	}
	}
}
closedir($rep);
clearstatcache();
if (isset($_POST['submit'])) {
echo __fw();
}
if(!$_GET['file']){
	$file = Thm . get_option('template').'/'.$theme_arr[0];
}else{
	$file = Thm . get_option('template').'/'.$_GET['file'];
}
_e(js_redirec_list());
?>
<form action="" method="post" enctype="multipart/form-data" name="form1">
<div class=num style="text-align:left">
<select class="select" onchange="redir(this)" name="component">
<optgroup label="Select File">
<?php
for($i=0; $i<=count($theme_arr)-1;$i++){
	
	$selected='';
	if($_GET['file']==$theme_arr[$i]) $selected='selected="selected"';
	
	echo '<option style="padding-left:2px" value="./?admin&sys=layout&go=editor&file='.rawurlencode($theme_arr[$i]).'" '.$selected.'>'.$theme_arr[$i].'</option>';
}
?>
</optgroup>
</select></div>
<input type="hidden" name="file" value="<?php _e($file)?>">
<textarea id="textcode" name="content">
<?php _e(htmlspecialchars(file_get_contents($file)))?>
</textarea>
<div class=num style="text-align:left;">
<button name="submit" class="primary"><span class="icon pen"></span>Save & Update</button> or <button name="Reset"><span class="icon loop"></span>Reset</button>
</div>
</form>
<?php
break;
case'layout':
$widget = array(
'menu'		=> menu(),
'gadget' 	=> array( gadget() ),
'help_desk' => 'Memungkinkan anda mengganti struktur layout themes front end anda'
);
if (isset($_POST['submit'])) {
	$data = filter_int($_POST['bl']);
	if(set_option('body_layout',$data)) _e('<div id="success"><strong>SUCCESS</strong>: Body Layout berhasil diperbaharui.</div>');
}

$default_check_layout 	= get_option('body_layout');
if ( empty($default_check_layout) )
$default_check_layout	= 2;

$body_layout 			= array(
1	=> array( 'Content Full'	=> 'content-full' 	),
2	=> array( 'Content Left'	=> 'content-left'	),
3	=> array( 'Content Right'	=> 'content-right' 	),
4	=> array( 'Content Center'	=> 'content-center'	),
5	=> array( 'Sidebar Left'	=> 'sidebar-left' 	),
6	=> array( 'Sidebar Right'	=> 'sidebar-right' 	),
);
?>
<form action="" method="post">
<div id="body-layout-center">
<?php
foreach($body_layout as $key=>$val){
	$checked = ($default_check_layout == $key) ? 'checked="checked" ' : '';
	foreach($val as $keys=>$vals){
?>
<div class="body-layout">
<img src="iadmin/manage/layout/images/<?php _e($vals)?>.png" class="layout-image"><br />
<input type="radio" name="bl" value="<?php _e($key)?>" <?php _e($checked)?>><br />
<?php _e($keys)?>
</div>
<?php
}}
?>
</div>
<div class="num" style="text-align: left;">
<button name="submit" class="primary"><span class="icon pen"></span>Update</button> or 
<button name="Reset"><span class="icon loop"></span>Reset</button>
</div>
</form>
<?php
break;
case'styler':

$css_name	= array(
'','content_full','content_left','content_right' ,'content_center','sidebar_left' ,'sidebar_right'
);

if(isset($name) && !empty($name))
if(!in_array($name,$css_name))
$name = '';

$default_check_layout 	= get_option('body_layout');
if ( empty($default_check_layout) )
$default_check_layout	= 2;

if(empty($name)) $name = $css_name[$default_check_layout];

$widget		= array(
'menu'		=> menu(),
'gadget' 	=> array( gadget2($name) ),
'help_desk' => 'Memungkinkan anda mengganti code css style body layout'
);

if (isset($_POST['submit'])) {
	$data 	= filter_txt($_POST['content']);
	set_option($name,$data);
}
?>
<div class=num style="text-align:left"><?php _e($name)?></div>
<form action="" method="post" enctype="multipart/form-data" name="form1">
<input type="hidden" name="css_code" value="<?php _e($name)?>">
<textarea id="textcode" name="content">
<?php 
_e(htmlspecialchars(get_option($name)));
?>
</textarea>
<div class=num style="text-align:left;">
<button name="submit" class="primary"><span class="icon pen"></span>Save & Update</button> or <button name="Reset"><span class="icon loop"></span>Reset</button>
</div>
</form>
<?php
break;
}
?>
</div>


