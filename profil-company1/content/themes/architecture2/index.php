<?php
/**
 * The Index for our theme.
 *
 * @package ID
 * @subpackage Classic
 * @since Classic 1.3
 */
if(!defined('_iEXEC')) exit;
?><!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
<title><?php the_title( true );?></title>
<meta charset="<?php get_info( 'charset', true ); ?>">
<meta name="Description" content="<?php get_info( 'description', true ); ?>">
<meta name="Keywords" content="<?php get_info( 'keywords', true ); ?>">
<meta name="Robots\" content="<?php get_info( 'robots', true ); ?>">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link href="<?php get_template_directory_uri(true); ?>/css/reset.css" rel="stylesheet" type="text/css">
<link href="<?php get_template_directory_uri(true); ?>/css/style.css" rel="stylesheet" type="text/css">
<link href="<?php get_template_directory_uri(true); ?>/css/style-menu.css" rel="stylesheet" type="text/css" />
<link href="<?php get_template_directory_uri(true); ?>/css/message.css" rel="stylesheet" type="text/css" />
<link href="<?php get_template_directory_uri(true); ?>/css/nav-v.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="<?php get_template_directory_uri(true); ?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php get_template_directory_uri(true); ?>/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php get_template_directory_uri(true); ?>/js/tms-0.3.js"></script>
<script type="text/javascript" src="<?php get_template_directory_uri(true); ?>/js/tms_presets.js"></script>
<script type="text/javascript" src="<?php get_template_directory_uri(true); ?>/js/script.js"></script>
<script>
$(function() {
	$('.vertical li:has(ul)').addClass('parent');
	$('.horizontal li:has(ul)').addClass('parent');
});
$(document).ready(function(){
	$("#featured > ul").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 7000, true);
});
</script>
<?php the_head();?>
</head>
<body>
  <div id="wrapper">
    <div id="left">
    <?php if( function_exists('sidebar_widgets') ){ sidebar_widgets(); }?>
    </div>
    <div id="right">
  	<?php //if( !isset($_GET[com]) ){?>
    <div id="header">
    
					<div class="slider_bg">
						<div class="slider">
                        <?php get_search_form(); ?>
							<ul class="items">
                            <?php 
							$limit_slide = architecture2_theme_option('limit_slide');
							if( empty($limit_slide) )
								$limit_slide = 3;
							
							for($i=1;$i<=$limit_slide;$i++){
							?>
								<li>
									<img src="<?php echo site_url("content/uploads/slider/ke-$i.jpg");?>" alt="">
								</li>
                            <?php }?>
							</ul>
						</div>
					</div>
    </div>
    <?php //}?>
    <?php the_content();?>
    </div>
    <div class="clear"> </div>
    <div id="spacer"> </div>
    <div id="footer">
      <div id="copyright" class="left">
        <?php echo get_option('site_copyright');?>
      </div>
      <div class="right">
      <ul id="icons">
      <?php 
	  global $login;
	  if( $login->check() ):?>
							<li><a href="<?php echo site_url();?>/?login=go=logout" class="normaltip" title="Logout"><img src="<?php get_template_directory_uri(true); ?>/images/icon6.gif" alt=""></a></li>
                         <?php else:?>
							<li><a href="<?php echo site_url();?>/?login" class="normaltip" title="Login"><img src="<?php get_template_directory_uri(true); ?>/images/icon6.gif" alt=""></a></li>
                         <?php endif;?>
                            
							<li><a href="#" class="normaltip" title=""><img src="<?php get_template_directory_uri(true); ?>/images/icon1.gif" alt=""></a></li>
							<li><a href="#" class="normaltip" title="Twitter"><img src="<?php get_template_directory_uri(true); ?>/images/icon3.gif" alt=""></a></li>
						</ul>
      </div>
	  <div class="clear"></div>
    </div>
	
  </div>
</body>
</html>
