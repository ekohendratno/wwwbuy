<?php
/**
 * @file: sexybookmarks.php
 * @type: plugin
 */
/*
Plugin Name: Sexy Bookmarks
Plugin URI: http://cmsid.org/#
Description: Media social bookmarking yang populer saat ini.
Author: Eko Azza
Version: 1.1.0
Author URI: http://cmsid.org/
*/
//not direct access
defined('_iEXEC') or die();

function __wt($data)
{
	if($data!=''){
		$return = str_replace(' ','+',$data);
		return $return;
	}
}
function __($text) {
	return $text;
}

function load_sexybookmarks($item=false){
	
include 'install.php';

install_sexybookmarks();

if( get_option( 'sexybookmarks') ) :

global $shrsb_bookmarks_data;

include 'bookmarks-data.php';

$sexybookmarks_value = get_option( 'sexybookmarks');
$obj_feed = jdecode($sexybookmarks_value);

if($obj_feed->{'status'} < 1 )
return false;
/*
 *list bg bookmarks
 *
 *enjoy#german#knowledge#love-hearts#wealth#caring#caring-hearts#shr
 */
//select array bookmark bg
$nobgbookmarks	= $obj_feed->{'bg'}; //shr
//array bookmark bg
$bgbookmarks	= array('enjoy','german','knowledge','love-hearts','wealth','caring','caring-hearts','shr');
/*
 *list top bookmarks
 *
 *comfeed,delicious,digg,diigo,googlebuzz,misterwong,mixx,reddit,technorati,twitter,blogger,
 *designfloat,facebook,gmail,googlebookmarks,hotmail,identica,myspace,netvouz,yahoomail
 */
/**
 *array bookmark select
 */
$bookmarks_select   = $obj_feed->{'social'};
/**
 *total bookmarks_select
 */
?>
<div class="shr-bookmarks shr-bookmarks-expand shr-bookmarks-center shr-bookmarks-bg-<?php echo $bgbookmarks[$nobgbookmarks];?>">
<ul class="socials">
<?php foreach($bookmarks_select as $key => $val){?>
<li class="shr-<?php echo $val;?>">
<a href="<?php echo $shrsb_bookmarks_data['shr-'.$val]['baseUrl'];?>" rel="nofollow" class="external" title="<?php echo $shrsb_bookmarks_data['shr-'.$val]['share'];?>">&nbsp;</a>
</li>
<?php }?>
</ul>
<div style="clear:both;"></div>
</div>
<?php
endif;
}
?>