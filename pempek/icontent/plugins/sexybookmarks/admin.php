<?php
/**
 * @file: admin.php
 * @type: plugin-sexybookmarks
 */ 
//not direct access
defined('_iEXEC') or die();

global $shrsb_bookmarks_data;

include 'install.php';
include 'bookmarks-data.php';

install_sexybookmarks();

echo '<link rel="stylesheet" href="'.plugin_url('sexybookmarks/style-admin.css').'" type="text/css" media="all" />';
?>
<div class="box-head dotted">Sexybookmarks</div>
<div id="box-content">
<?php
$sexybookmarks_value 	= get_option( 'sexybookmarks' );
$obj_feed 				= jdecode($sexybookmarks_value);
?>
<form action="" method="post">
<?php
$bgbookmarks	= array('enjoy','german','knowledge','love-hearts','wealth','caring','caring-hearts','shr');

foreach($bgbookmarks as $val){
echo '<div style="float:left; width:300px; height:60px; border:1px solid #ddd;">';
echo '<div class="shr-bookmarks-bg-'.$val.'"><input type="radio" name="radio" id="radio" value="radio" /></div>';
echo '</div>';
}
?>
</form>
</div>

