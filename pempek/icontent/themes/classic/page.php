<?php 
defined('_iEXEC') or die();

set_layout('left');
$id 				= post_item_id('page',$_GET['id']);
$GLOBALS['title'] 	= page('title',$id);
$GLOBALS['desc']  	= limittxt(htmlentities(strip_tags(page('content',$id ))),200);
?>
<h1  class="border">
<?php 
if(page('title',$id)==false){
	_e('Page Not Found');
}else{
	_e(page('title',$id));
}
?>
</h1>
<div class="border">
<?php 
if(page('content',$id)==false){
	_e('Apologies, but the Page you requested could not be found');
}else{
	_e(page('content',$id));
}
?>
</div>






