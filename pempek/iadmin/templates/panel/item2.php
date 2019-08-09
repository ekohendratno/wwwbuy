<?php
/**
 * @file chek-update.php
 *
 */
//dilarang mengakses
defined('_iEXEC') or die();

$widget_ID 			= 'feed-news';
$feed_news_value	= get_option('feed_news');
$feed_obj			= jdecode($feed_news_value);
$feed_judul 		= is_empty($feed_obj->{'feed_judul'},'Feed News');
$feed_url 			= is_empty($feed_obj->{'feed_url'},'http://cmsid.org/rss.xml');
$feed_select 		= is_empty($feed_obj->{'feed_list'},5);
$feed_content 		= is_empty($feed_obj->{'feed_content'});
$feed_author 		= is_empty($feed_obj->{'feed_author'});
$feed_date 			= is_empty($feed_obj->{'feed_date'});
$list_check   		= array();
$list_check[] 		= array('feed_content','Display item content?',$feed_content);
$list_check[] 		= array('feed_author','Display item author if available?',$feed_author);
$list_check[] 		= array('feed_date','Display item date?',$feed_date);
$list 				= array(
		'minmax'	=>array('min'=>1,'max'=>10),
		'select'	=>$feed_select
);


if(!function_exists('set_feed_widget')){
	function set_feed_widget($data){	
		extract($data,EXTR_SKIP);
		
		$feed_judul 	= esc_sql( $feed_judul	);
		$feed_url 		= esc_sql( $feed_url	);
		$feed_list 		= esc_sql( $feed_list	);
		
		$feed_content 	= esc_sql( $feed_content 	); 
		$feed_author 	= esc_sql( $feed_author 	); 
		$feed_date 		= esc_sql( $feed_date 		); 
				
		
		$values_feed  	= compact('feed_judul','feed_url','feed_list','feed_content','feed_author','feed_date');
		$value_feed	  	= jencode($values_feed);
		
		
		if( !get_option( 'feed_news') ) add_option( 'feed_news', $value_feed );
		else set_option( 'feed_news', $value_feed );
		
		if(function_exists('redirect')) redirect('?admin');
		
	}
}

?>
<h3><?php echo $feed_judul; widget_title($widget_ID)?></h3>
<div class="dragbox-content">
<?php 
if(widget_edit($widget_ID)):

if(!class_exists('forms_generator')):
echo '<div id="error"><strong>ERROR : </strong>Class forms not found</div>';

else:

if(isset($_POST['submit'])){
	$feed_url 		= filter_txt( $_POST['feed_url']	);
	$feed_judul 	= filter_txt( $_POST['feed_judul']	);
	$feed_list 		= filter_txt( $_POST['feed_list']	);
	$feed_content	= filter_int( $_POST['feed_content']);
	$feed_author	= filter_int( $_POST['feed_author']	);
	$feed_date		= filter_int( $_POST['feed_date']	);
	
	set_feed_widget(compact('feed_judul','feed_url','feed_list','feed_content','feed_author','feed_date'));
}

$form = new forms_generator;
echo $form->head();
echo 'Feed judul: <br>'.$form->input('feed_judul','input',$feed_judul);
echo 'Masukkan URL RSS Feed disini: <br>'.$form->input('feed_url','input',$feed_url);
echo 'Berapa banyak yang ditampilkan '.$form->input('feed_list','list',$list).'<br>';
echo $form->input('feed_item','check',$list_check).'<br>';
echo $form->button('Submit');
echo $form->foot();

endif;
else:

if(!class_exists('Rss')):
echo '<div id="error"><strong>ERROR : </strong>Class Rss not found</div>';

else:
$Rss = new Rss; // create object


/*
	XML way
*/
try {
	$feed = $Rss->getFeed($feed_url, Rss::XML);
	echo '<ul class="ul-box">';
	$i = 1;
	foreach($feed as $item)	{
		if($i <= $feed_select){
	?>
<li>
<a style="font-weight:700;" href="<?php _e($item['link'])?>" title="<?php _e(limittxt(strip_tags($item['description']),120))?>">
<?php _e($item['title']);?></a>
<?php if($feed_author == 1 || $feed_date == 1 ):?>
<div style="color:#333; font-size:10px">
<?php if($feed_author == 1):?>
<?php _e($item['author'].' - ')?>
<?php endif;?>
<?php if($feed_date == 1):?>
<?php _e(datetimes($item['date']))?>
<?php endif;?>
</div>
<?php endif;?>
<?php if($feed_content == 1):?>
<div style="color:#333"><?php _e(limittxt(strip_tags($item['description']),120))?></div>
<?php endif;?>
</li>
    <?php
		}
	$i++;
	}
	echo '</ul>';
}
catch (Exception $e) {
	echo $e->getMessage();
}
?>
<?php ?>
<?php 
endif;
endif;
?>
</div>


