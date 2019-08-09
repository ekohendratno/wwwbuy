<?php
/**
 * @file album.php
 *
 */
//dilarang mengakses
defined('_iEXEC') or die();
set_layout('left')
?>
<div style="background:#fff; padding:10px; margin:0 30px 0 30px; border-top:5px solid #900;">
<h2>Our Contact</h2>
<style type="text/css">
<?php
$string_css = '
#album-category .category-foto a:hover .foto-bg, #album-category .category-foto a:hover .foto-thumb{
	border			:1px solid #ab0002;	
	cursor			:pointer;
}
#album-category{
	height			:180px;
	width			:180px;
	margin			:20px 0 0 0;
}
#album-category .category-foto{
	height			:130px;
}
#album-category .category-title{
	height			:30px;
	text-align		:left;
	margin-top		:15px;
	margin-left		:10px;
}
#album-category .category-title-h{
	font-size		:12px;
	color			:#000;
}
#album-category .category-title-j{
	font-size		:10px;
	color			:#000;
}
#album-category .foto-bg{	
	width			:100%;
	height			:100%;
	border			:1px solid #ccc;
	background		:#fff;
}
#album-category .foto-thumb{
	position		:relative;
	left			:5px;
	top				:5px;
	width			:180px;
	height			:130px;
	border			:1px solid #ccc;
	background		:#fff;
	padding			:2px;
}
#album-category img.foto-img{
	position		:relative;
	left			:0;
	top				:3px;
	width			:95%;
	height			:95%;
	border			:1px solid #f2f2f2;
	background		:#f2f2f2;
	line-height		:83px;

}
';
?>
<?php echo css_compress($string_css)?>
</style>
<?php
global $iw, $db;
switch($_GET['view']){
	default:
$jml_kolom	= 3;
$limit		= 10;
$a			= new paging();
$q			= $a->query( "SELECT * FROM `".$iw->pre."album_cat` WHERE status=1 ORDER BY `id` DESC", $limit);
$jml_baris 	= $db->num($q);
?>

<?php
if ($jml_baris > 0) {
?>
<table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:30px;"><tr>
<?php 
$cnt = 0;
while ($w = $db->fetch_array($q)) {
if ($cnt >= $jml_kolom) {
?>
</tr><tr>
<?php 
$cnt = 0;
}
$cnt++;
$q2			= $db->select('album',array('cat'=>$w['id'],'status'=>1),'ORDER BY date DESC');
$w2 		= $db->fetch_array($q2);
$jumData 	= $db->num($q2);
?>
<td align="center">
<div id="album-category">
<div class="category-foto">
<?php $data_post = array('view'=>'category','id'=>$w['id'],'title'=>$w['title']);?>
<a href="<?php _e(do_links('album',$data_post));?>">
<div class="foto-bg">
<div class="foto-thumb">
<img class="foto-img" src="<?php echo $iw->base_url .'irequest.php?load=thumb&app=album&src='.$w2['image'].'&x=171&y=123&c=1';?>" style="max-height:100%;max-width:100%;">
</div>
</div>
</a>
</div>
<div class="category-title">
<span class="category-title-h"><?php echo limittxt($w['title'],20);?></span><br />
<span class="category-title-j"><?php echo $jumData;?> foto</span>
</div>
</div>
</td>
<?php
}
?>
</tr></table>
<?php
$no++;
}
?>

<?php
//halaman navigasi
echo $a->pg( 'album' );
	break;
	case'category':
?>
<div style="padding:2px"><a href="<?php _e(do_links('album'));?>">Back</a></div>
<script type="text/javascript" src="<?php echo apps_url('album/fancybox-1.3.4.compress.js');?>"></script>
<link href="<?php echo apps_url('album/fancybox-1.3.4.css');?>" type="text/css" rel="stylesheet"/>
<script type="text/javascript">
var $j = jQuery.noConflict();
$j(document).ready(function(){
$j(".fancy").fancybox();
});
</script>

<?php
$cid		= filter_int($_GET['id']);
$jml_kolom	= 2;
$limit		= 10;
$a			= new paging();
$q			= $a->query( "SELECT * FROM `".$iw->pre."album` WHERE  cat='$cid' AND status=1 ORDER BY `date` DESC", $limit);
$jml_baris 	= $db->num($q);
if ($jml_baris > 0) {
?>
<table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:30px;"><tr>
<?php 
$cnt = 0;
while ($w = $db->fetch_array($q)) {
if ($cnt >= $jml_kolom) {
?>
</tr><tr>
<?php 
$cnt = 0;
}
$cnt++;
?>
<td align="center">
<div id="album-category">
<div class="category-foto">
<a class="fancy" href="<?php echo $iw->base_url .'irequest.php?load=thumb&app=album&src='.$w['image'].'&x=400&y=400&c=1';?>">
<div class="foto-thumb">
<img class="foto-img" src="<?php echo $iw->base_url .'irequest.php?load=thumb&app=album&src='.$w['image'].'&x=171&y=123&c=1';?>" style="max-height:100%;max-width:100%;">
</div>
</a>
</div>
<div class="category-title">
<span class="category-title-h"><?php echo limittxt($w['title'],23);?></span><br />
</div>
</div>
</td>
<?php
}
?>
</tr></table>
<?php
$no++;
}
?>

<?php
//halaman navigasi
echo $a->pg( 'album',array('view'=> 'category', 'id'=> $cid) );
	break;
}
?>      
</form>					

