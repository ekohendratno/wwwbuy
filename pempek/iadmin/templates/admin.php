<?php
/**
 * @file admin.php
 *
 */
//dilarang mengakses
defined('_iEXEC') or die();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Administrator &bull; <?php
if(isset($_GET['apps']) && !empty($_GET['apps']))
	_e(uc_first($_GET['apps']));
elseif(isset($_GET['sys']) && !empty($_GET['sys']))
	_e(uc_first($_GET['sys']));
else
	_e('Dashboard');

?>
</title>
<link href="iadmin/templates/css/import-style.php" rel="stylesheet" media="screen" type="text/css" />
<?php
$admin_styles = array(
'codemirror',
'codemirror-default',
'jquery.uniform',
'cupertino/jquery-ui-1.8.14.custom'
);
$admin_scripts = array(
'codemirror/codemirror',
'codemirror/xml',
'codemirror/php',
'codemirror/javascript',
'codemirror/css',
'codemirror/htmlmixed',
'jquery-1.6.2',
'jquery.json-2.2.min',
'jquery-ui-1.8.16',
'jquery.ata',
'jquery.uniform',
'jquery.dataTables',
'jquery.paginate-1.0', 
);
stylesheet_url($admin_styles);
javascript_url($admin_scripts);
include 'function-script.php';
print_scripts();
?>
</head>

<body>

<div id="head-bg"></div>
<div id="wrapper">
<div id="top">
<div id="menu-users">
<ul>
<li><a href="#" style="min-width:100px"><div  class="icon user">Administrator</div></a>
<ul>
<li><a href="?login&go=profile"><div  class="icon users">Profile</div></a></li>
<li><a href="?admin&amp;sys=options&go=setting"><div  class="icon settings">Setting</div></a></li>
<li><a href="?admin&amp;apps=contact"><div  class="icon chatbubbles">Messages</div></a></li>
<li style="border-bottom:1px solid #ccc;"><a href="?login&amp;go=logout" onclick="return confirm('Are You sure logout?')"><div  class="icon lock">Logout</div></a></li>
</ul>
</li>
<li><a href="?admin&amp;apps=contact&act=inbox" title="<?php _e(count_inbx_msg())?> pesan baru" class="tip"><div  class="icon chatbubbles"><?php _e(count_inbx_msg())?></div></a></li>
<li><a href="./" title="Lihat situs" class="tip" target="_blank"><div  class="icon computer">&nbsp;</div></a></li>
</ul>
</div>
</div>
<div id="menu">
<div id="menu-app">
<?php
global $access,$session;
if($access->cek_login()){
$data_user 	= array('user_login' => $session->get('user_name'));
$field 		= $access->username_cek( $data_user );
?>
<div class="user_author">
<img src="<?php echo get_gravatar($field['row']['user_email']);?>" class="user_avatar">
<div class="user_author_name" title="Name Author"><?php echo $field['row']['user_author'];?></div>
<div class="user_time_log" title="User Log Update"><?php echo datetimes($field['row']['user_last_update'],false);?></div>
</div>
<?php
}
?>
<ul>
<li><a href="?admin"><div class="icon home">Dashboard</div></a></li>
<li><a href="?admin&sys=plugins"><div  class="icon brush">Plugins</div></a></li>
<li style="width:127px;"><a href="#"><div class="icon frames">Applications</div></a>
<ul>
<?php
$i		= 1;
$apps 	= list_top_menu(App);
$jum	= count($apps);
$select = '';
foreach( $apps as $k){
if($i==$jum) $select = 'style="border-bottom:1px solid #ccc;"';
?>
<li <?php _e($select)?>><a href="?admin&amp;apps=<?php _e($k)?>"><div  class="icon frames"><?php _e( uc_first($k) )?></div></a></li>
<?php
$i++;
}
?>
</ul>
</li>
<!--#-->
</ul>
</div>
</div>
<div style="clear:both"></div>
<div id="breadcrumb">
<ul class="left">
<li class="icon dashboard"><a href="?admin">Homes</a></li>
<?php 
if(isset($_GET['apps']) || isset($_GET['sys']) ){
if(isset($_GET['apps']) && !empty($_GET['apps'])){?>
<li class="icon point_right"><a href="?admin"><?php _e(uc_first($_GET['apps']))?></a></li>
<?php }if(isset($_GET['sys']) && !empty($_GET['sys'])){?>
<li class="icon point_right"><a href="?admin"><?php _e(uc_first($_GET['sys']))?></a></li>
<?php }if(isset($_GET['go']) && !empty($_GET['go'])){?>
<li class="icon point_right"><a href="?admin"><?php _e(uc_first($_GET['go']))?></a></li>
<?php }if(isset($_GET['act']) && !empty($_GET['act'])){?>
<li class="icon point_right"><a href="?admin"><?php _e(uc_first($_GET['act']))?></a></li>
<?php 
}}?>
</ul>
<ul class="right">
	<li><a href="#" class="icon support tip" title="FAQ">FAQ</a></li>
	<li><a href="?admin" class="icon home tip" title="Home">Home</a></li>
</ul>
</div>

<?php
if(get_option('welcom_message')==1){
?>
<div class="notification-wrap">
        <div class="notification note_info">
            <span></span>
            <div class="text">
                <p><strong>Info!</strong> This is a info notification. Selamat datang di Administrator.</p>
            </div>
    	</div>
        <div class="description">
            <p>Terimakasih sebelumnya sudah menggunakan opensource karya anak bangsa, semoga opensource kami dapat menjadikan motifasi dan meningkatkan sumber daya manusia yang lebih maju lagi dari yang sebelumnnya. Untuk menghilangkan notifikasi ini silahkan klik <a href="?admin&sys=options&go=privacy">disini</a> dan ubah opsi admin message menjadi hidden, terimakasih. salam <a href="http://cmsid.org">id</a>.</p>
            <span></span>
        </div>
    </div>
<?php
}
?>
<div style="clear:both"></div>
<div id="content">
<div id="leftbar">

<div class="menu-head">Action</div>

<ul class="menu-box">
<li><a href="?admin">Dashboard</a></li>
<?php if(isset($widget['menu'])):?>
<?php foreach($widget['menu'] as $key => $val){ ?>
<li><a href="<?php _e($val['link']);?>"><?php _e($val['title']);?></a></li>
<?php }?>
<?php else:?>
<li><a href="?admin&update">Updates</a></li>
<li><a href="?admin&widget">Widgets</a></li>
<?php endif;?>
</ul>

<div class="menu-head">Help Desh</div>
<div class="box-info">
<?php
if(isset($widget['help_desk'])){
	_e($widget['help_desk']);
}else{
?>
Welcome to ID Admin Template! We hope you enjoy your stay and be sure to check out the other pages
<?php
}
?>
</div>

</div>
<!--#rightbar-->
<div id="rightbar">
<!---->
<div id="rightbar-content">

<div class="content-box">

<?php
if(isset($_GET['update']) && $_GET['update']==''){
?>
<div class="box-head dotted">Updates</div>
<div id="box-content">
<?php system_cheking_updates_ID() ?>
</div>
<?php
}
else echo $content;
?>

</div>
<div style="clear:both;"></div>

</div>
<!---->
<?php
if(isset($widget['gadget']) && !empty($widget['gadget'])){
?>
<!--||-->
<div id="rightbar-widget">
<div id="border-left">
<?php
foreach(array_keys($widget['gadget']) as $key){
?>
<div id="box">
<div class="box-head"><?php _e($widget['gadget'][$key]['title']);?></div>
<div class="box-content"><?php _e($widget['gadget'][$key]['desc']);?></div>
</div>
<?php
}
?>
</div>
<div style="clear:both;"></div>

</div>
<?php
}else{
?>
<style type="text/css">
#rightbar-content {float: left;width: 99.5%}
</style>
<?php
}
?>
<!--||-->
</div>
<!--#rightbar end-->
</div>
<div style="clear:both;"></div>

<div class="footer" style="border-top:1px solid #eee;">
<div class="footer-left">
Copyright &copy; 2011 <b><?php _e(get_option('copyright'));?></b> &bull; Powered by <b><?php _e(get_option('poweredby'));?></b>
</div>
<div class="footer-right">
<a href="#" target="_blank">About</a> &bull; <a href="#" target="_blank">Lisency</a> &bull; <a href="#" target="_blank">Term</a> &bull; <a href="#" target="_blank">Help</a>
</div>
</div>
<div style="clear:both"></div>

</div>

</div>

</body>
</html>