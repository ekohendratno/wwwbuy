<?php
/**
 * @file login.php
 *
 */
//dilarang mengakses
defined('_iEXEC') or die();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Login &bull; <?php _e(get_option('web_title'));?></title>
<link href="iadmin/templates/css/import-style-login.php" rel="stylesheet" media="screen" type="text/css" />
<!-- shitload of crap for IE -->
<!--[if IE]><script src="iadmin/templates/js/html5.js" type="text/javascript"></script><![endif]-->
<!--[if lt IE 8]><script src="iadmin/templates/js/IE8.js" type="text/javascript"></script><![endif]-->
<!-- END -->

<script type="text/javascript">
addLoadEvent = function(func){
	if(typeof jQuery!="undefined")jQuery(document).ready(func);
	else if(typeof Onload!='function'){
		Onload=func;
	}else{
		var oldonload=Onload;
		Onload=function(){
		oldonload();
		func();
	}}};
function s(id,pos){
	g(id).left=pos+'px';
}
function g(id){
	return document.getElementById(id).style
}
function shake(id,a,d){
	c=a.shift();
	s(id,c);
	if(a.length>0){
		setTimeout(function(){
			shake(id,a,d);},d);
		}else{
			try{
				g(id).position='static';
			}catch(e){
	}}}
addLoadEvent(function(){ 
var p=new Array(10,20,10,0,-10,-20,-10,0);
    p=p.concat(p.concat(p));
var i=document.forms[0].id;
	g(i).position='relative';
	shake(i,p,20);
});
</script>
</head>

<body>

<div id="head-bg"></div>
<div id="wrapper">
<div id="top">
<div id="menu-users">
<ul>
<li><a href="?login" title="Home" class="tip"><div  class="icon home">&nbsp;</div></a></li>
<li><a href="?login&amp;go=register" title="Create Account" class="tip"><div  class="icon user_add">&nbsp;</div></a></li>
<?php 
global $access;
if($access->cek_login()){?>
<li><a href="?login&amp;go=profile" title="Profile" class="tip"><div  class="icon users">&nbsp;</div></a></li>
<li><a href="?login&amp;go=logout" title="Logout" class="tip" onclick="return confirm('Are You sure logout?')"><div  class="icon lock">&nbsp;</div></a></li>
<?php }?>
<li><a href="./" title="Lihat situs" class="tip"><div  class="icon computer">&nbsp;</div></a></li>
</ul>
</div>
</div>
<div style="clear:both"></div>
<div id="content">
<?php
echo $CONTENT;
?>
<div style="clear:both;"></div>
<div class="footer">
All Right Reserved &bull; Powered by <b><?php _e(get_option('poweredby'));?></b>
</div>
</div></div>
<script type="text/javascript">
if(typeof Onload=='function')Onload();
</script>
</body>
</html>
