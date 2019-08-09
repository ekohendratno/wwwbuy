<?php
/**
 * @file rec-reg.php
 *
 */
//dilarang mengakses
defined('_iEXEC') or die();
global $iw,$db;
$obj = country();
?>
			<h3>Recent Registration</h3>
			<div class="dragbox-content" >

<!--start-tabs-->
<ul class="recent_reg">
<li><a href="#reg-date">Date</a></li>
<li><a href="#reg-country">Country</a></li>
</ul>
<div class="tabs-content">
<div id="reg-date" class="tab_recent_reg">
<ul class="ul-box">
<?php
$query	= $db->select('users',null,'ORDER BY user_registered DESC LIMIT 10');
while($data	= $db->fetch_obj($query)){
?>
<li><?php _e(uc_first($data->user_author));?><span>
<?php 
if($data->user_sex==1){
	_e('Pria');
}else{
	_e('Wanita');
}
?>
</span><span>
<?php 
if(!empty($data->user_country)) _e($obj->CountryName($data->user_country));
else _e('unknow');
_e('-');
if(!empty($data->user_province)) _e($data->user_province);
else _e('unknow');
?>
</span><span><?php _e(dateformat($data->user_registered));?></span></li>
<?php
}
?>
</ul>
</div>
<div id="reg-country" class="tab_recent_reg">
<ul class="ul-box">
<?php
$q		= $db->query("
SELECT user_registered, user_country, COUNT(user_login) AS t_user
FROM ".$iw->pre."users
GROUP BY user_country
ORDER BY user_registered DESC
LIMIT 10
");
while($data	= $db->fetch_obj($q)){
?>
<li><?php _e(uc_first($obj->CountryName($data->user_country)));?><span><?php _e($data->t_user);?> Registration</span><span><?php _e(dateformat($data->user_registered));?></span></li>
<?php
}
?>
</ul>
</div>
</div>
<!--end-tabs-->

			</div>


