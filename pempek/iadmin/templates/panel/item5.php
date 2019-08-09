<?php
/**
 * @file quick-link.php
 *
 */
//dilarang mengakses
defined('_iEXEC') or die();
global $iw,$db;
?>
			<h3>Viewed Post </h3>
			<div class="dragbox-content" >

<!--start-tabs-->
<ul class="view_post">
<li><a href="#view-post-last">Most</a></li>
<li><a href="#view-post-top">Top</a></li>
</ul>
<div class="tabs-content">
<div id="view-post-last" class="tab_view_post">
<ul class="ul-box">
<?php
$query	= $db->select('post',array('type'=>'post'),'ORDER BY `date_update` DESC LIMIT 10');
while($data	= $db->fetch_obj($query)){
?>
<li title="<?php _e($data->title)?>"><?php _e(limittxt(strip_tags($data->title),50));?><span><?php _e($data->hits);?></span></li>
<?php
}
?>
</ul>
</div>
<div id="view-post-top" class="tab_view_post">
<ul class="ul-box">
<?php
$query		= $db->select('post',array('type'=>'post'),'ORDER BY hits DESC LIMIT 10');
while($data	= $db->fetch_obj($query)){
?>
<li><?php _e(limittxt(strip_tags($data->title),50));?><span><?php _e($data->hits);?></span></li>
<?php
}
?>
</ul>
</div>
</div>
<!--end-tabs-->

			</div>


