<?php
/**
 * @file ref-urls.php
 *
 */
//dilarang mengakses
defined('_iEXEC') or die();
global $iw,$db;
?>
			<h3>Referring URLS</h3>
			<div class="dragbox-content" >
            
<!--start-tabs-->
<ul class="referr_urls">
<li><a href="#ref-new">New</a></li>
<li><a href="#ref-top">Top</a></li>
<li><a href="#ref-domain">Domain</a></li>
<li><a href="#ref-keywords">Keywords</a></li>
</ul>
<div class="tabs-content">
<div id="ref-new" class="tab_referr_urls">
<ul class="ul-box">
<?php
global $iw, $db;
$query		= $db->select('stat_urls',null,'ORDER BY `date_modif` DESC LIMIT 10');
while($data	= $db->fetch_obj($query)){
	if(!empty($data->referrer)){
	?>
  <li title="<?php _e(str_replace('http://', '', $data->referrer));?>"><a href="<?php _e($data->referrer)?>"><?php _e(limittxt(str_replace('http://', '', $data->referrer),50));?></a><span><?php _e($data->hits);?></span></li>
	<?php
	}
}
?>
</ul>
</div>
<div id="ref-top" class="tab_referr_urls">
<ul class="ul-box">
<?php
$query	= $db->select('stat_urls',null,'ORDER BY `hits` DESC LIMIT 10');
while($data	= $db->fetch_obj($query)){
	if(!empty($data->referrer)){
	?>
  <li title="<?php _e(str_replace('http://', '', $data->referrer));?>"><a href="<?php _e($data->referrer)?>"><?php _e(limittxt(str_replace('http://', '', $data->referrer),50));?></a><span><?php _e($data->hits);?></span></li>
	<?php
	}
}
?>
</ul>
</div>

<div id="ref-domain" class="tab_referr_urls">
<ul class="ul-box">
<?php
$query	= $db->select('stat_urls',null,'GROUP BY  `domain` LIMIT 10');
while($data	= $db->fetch_obj($query)){
		if(!empty($data->domain)){
		?>
  <li><a href="<?php _e($data->referrer)?>"><?php _e($data->domain);?></a><span><?php _e($data->hits);?></span></li>
		<?php
		}
}
?>
</ul>
</div>

<div id="ref-keywords" class="tab_referr_urls">
<ul class="ul-box">
<?php
$search_terms 	= $search_terms_hits = $search_terms_links = array();
$query			= $db->select('stat_urls',null,'GROUP BY `search_terms` ORDER BY `date_modif` DESC');
while($data		= $db->fetch_obj($query)){
	if(!empty($data->search_terms)){
		$search_terms[] = $data->search_terms;
		$search_terms_hits[] = $data->hits;
		$search_terms_links[] = $data->referrer;
	}
}
?>
<?php 
foreach($search_terms as $key => $val){ 
if( $key <= 10 ){
?>
  <li><a href="<?php _e($search_terms_links[$key])?>"><?php _e($val);?></a><span><?php _e($search_terms_hits[$key]);?></span></li> 
<?php 
}}
?>
</ul>
</div>


</div>
<!--end-tabs-->

			</div>