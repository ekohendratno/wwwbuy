<?php
/**
 * The Index for our theme.
 *
 * @package ID
 * @subpackage Classic
 * @since Classic 1.1
 */
defined('_iEXEC') or die();?>
<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
<meta charset="<?php echo get_info( 'charset' );?>">
<title><?php echo do_template('meta','title');?></title>
<meta name="Description" content="<?php echo do_template('meta','desc');?>">
<meta name="Keywords" content="<?php echo do_template('meta','key');?>">
<?php iw_head();?>
</head>
<body>
<div id="wrap">

<div class="wrap-top"></div>
<!--start-head-->
<div id="header"> 
<div id="text">
<div class="logo-ID" title="<?php index('webtitle');?>"></div>
</div>
<ul style="width:350px;">
<li><a href="<?php _e(do_template('url','base'));?>"><span>Home</span></a></li>
<li><a href="<?php _e(do_links('post'));?>"><span>Article</span></a></li>
<li><a href="<?php _e(do_links('contact'));?>"><span>Contact Us</span></a></li> 
<li><a href="<?php _e(do_links('page',array('id'=>2,'title'=>'abouts')));?>"><span style="border-right:0;">About's</span></a></li> 
</ul>  
</div>
<!--start-content-->
<div id="wrap-content">
<!--content-wrap-->
<div id="content-wrap">
<!--start-left-->
<?php

if(do_template('active','sidebar-1')){
?>
<div id="sidebar">
<?php 
_e(do_template('main','sidebar-1'));?>
</div>
<?php }?>
<!--start-main-->
<div id="main">
<?php _e(do_template('main','content'));?>
</div> 
<!--start-right-->
<?php
if(do_template('active','sidebar-2')){
?>
<div id="rightbar">
<?php _e(do_template('main','sidebar-2'));?>
</div>
<?php }?>
</div>
</div>
<!--start-footer-->
<div id="footer"> 
<div id="footer_text">
<div class="footer-left">
<p>
<a href="<?php _e(do_template('url','base'));?>">Home</a>&nbsp;&bull;&nbsp;
<a href="<?php _e('http://cmsid.org/page/helps.html');?>">Helps ?</a>
<!--
<a href="<?php _e(do_links('contact'));?>">Contact Us</a>&nbsp;&bull;&nbsp;
<a href="<?php _e(do_links('page',array('id'=>3,'title'=>'privacy')));?>">Privacy</a>&nbsp;&bull;&nbsp;
<a href="<?php _e(do_links('page',array('id'=>4,'title'=>'term of use')));?>">Term of Use</a>&nbsp;&bull;&nbsp;
<a href="<?php _e(do_links('page',array('id'=>5,'title'=>'site credit')));?>">Site Credit</a>
-->
</p>
</div> 
<div class="footer-right">
<p class="align-right">
&copy; <b><?php _e(get_option('copyright'));?></b> <?php _e(date('Y'));?> &bull; Powered by <b><?php _e(get_option('poweredby'));?></b> TE : <?php _e(do_template('main','exe'));?>
</p>
</div>
</div>
</div>

</div>
</body>
</html>
