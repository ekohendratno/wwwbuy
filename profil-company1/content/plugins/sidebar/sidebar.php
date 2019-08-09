<?php
/**
 * @file: sidebar/sidebar.php
 * @dir: content/plugins
 */
 
/*
Plugin Name: Sidebar
Plugin URI: http://cmsid.org/#
Description: Plugin Sidebar
Author: Eko Azza
Version: 1.0
Author URI: http://cmsid.org/
*/ 

if(!defined('_iEXEC')) exit;

if( !function_exists('sidebar_widgets') ){
	function sidebar_widgets(){
		global $db, $login;
?>

      <div id="logo">
        <h1><a href="<?php echo site_url();?>"><img src="<?php echo architecture2_theme_option('logo');?>" /></a></h1>
      </div>
      <ul id="navmenu-v">
        <?php echo dynamic_menus(1, 'class="vertical fade"', false); ?>
      </ul>
      <div class="clear"></div>
      <div id="news">
        <h2>Latest News</h2>
        <?php
		$sqlFrontArtikel = $db->query( "SELECT * FROM `$db->post` WHERE type='post' AND approved='1' AND status='1' ORDER BY `date_post` DESC LIMIT 5" );
		while ($wFrontArtikel = $db->fetch_obj($sqlFrontArtikel)) {
		?>
        <h3><a href="<?php echo do_links('post',array('view'=>'item','id'=>$wFrontArtikel->id,'title'=>$wFrontArtikel->title));?>" rel="bookmark" title="<?php echo $wFrontArtikel->title;?>" class="readmore"><?php echo datetimes($wFrontArtikel->date_post,false);?></a></h3>
        <?php echo limittxt(strip_tags($wFrontArtikel->content),80);?>
        <?php }?>
        <p class="more"><a href="<?php echo do_links('post');?>">more</a></p>
      </div>
      <div id="support">
        <center>
        <?php
		$ads = architecture2_theme_option('ads');
		foreach($ads as $ads_k => $ads_v){
			if( !empty($ads_v) )
			echo "<img src=\"$ads_v\"/>";
		}
		?>
        </center>
      </div>
      <!--
      <div id="statistik">
        <h2>Meta</h2>
      	<ul>
			<?php if( $login->check() && $login->level('admin') ):?>
				<li><a href="<?php echo site_url('?admin')?>">Administrator</a></li>
			<?php endif;if( $login->check() ):?>
				<li><a href="<?php echo site_url('?login&go=logout')?>">Logout</a></li>
			<?php else:?>
				<li><a href="<?php echo site_url('?login')?>">Login</a></li>
                <?php if( get_option('account_registration') > 0 ):?>
				<li><a href="<?php echo site_url('?login&go=signup')?>">Register</a></li>
                <?php endif;?>
			<?php endif;?>
			</ul>

      </div>-->
      <div id="statistik">
        <h2>Statistik</h2>
      	<?php include "widget-statistik.php";?>
      </div>
<?php
return;
	}
}