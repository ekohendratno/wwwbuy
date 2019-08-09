<?php 
defined('_iEXEC') or die();

set_layout('left');
$id 				= post_item_id('page',$_GET['id']);
$GLOBALS['title'] 	= page('title',$id);
$GLOBALS['desc']  	= limittxt(htmlentities(strip_tags(page('content',$id ))),200);
?>
<div style="background:#fff; padding:10px; margin:0 30px 0 30px; border-top:5px solid #900;">
<h2>
<?php 
if(page('title',$id)==false){
	_e('Page Not Found');
}else{
	_e(page('title',$id));
}
?>
</h2>
<?php
$post_img='';
if(file_exists( Upload.'post/'.page('thumb',$id)))
$post_img='<img src="'.$iw->base_url.'icontent/uploads/post/'.page('thumb',$id).'" style="float:left; margin:0 5px 2px 2px; max-width:250px;max-height:250px;">';
_e($post_img);
?>
<?php 
if(page('content',$id)==false){
	_e('Apologies, but the Page you requested could not be found');
}else{
	_e(page('content',$id));
}
?>
</div>



