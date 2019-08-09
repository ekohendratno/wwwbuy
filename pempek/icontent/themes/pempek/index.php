<?php
/**
 * The Index for our theme.
 *
 * @package ID
 * @subpackage Classic
 * @since Classic 1.1
 */
defined('_iEXEC') or die();?>
<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
<meta charset="<?php echo get_info( 'charset' );?>">
<title><?php echo do_template('meta','title');?></title>
<meta name="Description" content="<?php echo do_template('meta','desc');?>">
<meta name="Keywords" content="<?php echo do_template('meta','key');?>">
<?php iw_head();?>
<link rel="stylesheet" href="<?php themes_url('css/reset.css')?>" type="text/css" media="all">
<link rel="stylesheet" href="<?php themes_url('css/layout.css')?>" type="text/css" media="all">
<link rel="stylesheet" href="<?php themes_url('css/style.css')?>" type="text/css" media="all">
<script type="text/javascript" src="<?php themes_url('js/jquery-1.6.js')?>" ></script>
<script type="text/javascript" src="<?php themes_url('js/cufon-yui.js')?>"></script>
<script type="text/javascript" src="<?php themes_url('js/cufon-replace.js')?>"></script>  
<script type="text/javascript" src="<?php themes_url('js/Forum_400.font.js')?>"></script>
<script type="text/javascript" src="<?php themes_url('js/jquery.easing.1.3.js')?>"></script>
<script type="text/javascript" src="<?php themes_url('js/tms-0.3.js')?>"></script>
<script type="text/javascript" src="<?php themes_url('js/tms_presets.js')?>"></script>
<script type="text/javascript" src="<?php themes_url('js/script.js')?>"></script>
<script type="text/javascript" src="<?php themes_url('js/atooltip.jquery.js')?>"></script> 

<!--[if lt IE 9]>
	<script type="text/javascript" src="<?php themes_url('js/html5.js')?>"></script>
	<style type="text/css">.slider_bg {behavior:url(<?php themes_url('js/PIE.htc')?>)}</style>
<![endif]-->
<!--[if lt IE 7]>
	<div style='clear:both;text-align:center;position:relative'>
		<a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" alt="" /></a>
	</div>
<![endif]-->
</head>
<body id="page1">
<div class="body6">
	<div class="body1">
		<div class="body5">
			<div class="main">
<!-- header -->
				<header>
					<h1><a href="index.html" id="logo">Deliccio Classic European Cuisine</a></h1>
					<nav>
						<ul id="top_nav">
							<li><a href="index.html"><img src="<?php themes_url('images/icon_1.gif')?>" alt=""></a></li>
							<li><a href="#"><img src="<?php themes_url('images/icon_2.gif')?>" alt=""></a></li>
							<li class="end"><a href="Contacts.html"><img src="<?php themes_url('images/icon_3.gif')?>" alt=""></a></li>
						</ul>
					</nav>
					<nav>
						<ul id="menu">
							<li><a href="<?php _e(do_template('url','base'));?>">Home</a></li>
							<li><a href="<?php _e(do_links('page',array('id'=>38,'title'=>'produk')));?>">Products</a></li>
							<li><a href="<?php _e(do_links('testimonial'));?>">Testimonial</a></li>
							<li><a href="<?php _e(do_links('album'));?>">Gallery</a></li>
							<li><a href="<?php _e(do_links('contact'));?>">Contacts</a></li>
						</ul>
					</nav>
				</header><div class="ic">More Website Templates  @ TemplateMonster.com - August 1st 2011!</div>
<!-- / header -->
<!-- content -->
<?php _e(do_template('main','content'));?>
<!-- / content -->
	</div>
</div>
<div class="body3">
	<div class="body4">
		<div class="main">
<!-- footer -->
			<footer>
				<div class="wrapper">
					<section class="col1 pad_left1"><!--E.Yopieyanty,Yahoo Messenger : eyopieyanty@yahoo.com & Blackberry Messenger Pin  219E0C18   Tlp. : 021-7089 1954, 021-8033 4666, HP. : 0815 7478 1976 ; FB : pempek8ulu.cikning@yahoo.co.id-->
						<?php echo get_option('contact_person');?>
					</section>
					<section class="col2 pad_left1">
						<h3>Follow Us </h3>
						<ul id="icons">
							<li><a href="#" class="normaltip" title="Facebook"><img src="<?php themes_url('images/icon1.gif')?>" alt=""></a></li>
							<li><a href="#" class="normaltip" title="Twitter"><img src="<?php themes_url('images/icon3.gif')?>" alt=""></a></li>
						</ul>
					</section>
				</div>
				<!-- {%FOOTER_LINK} -->
			</footer>
<!-- / footer -->
		</div>
	</div>
</div>
<script type="text/javascript"> Cufon.now(); </script>
</body>
</html>