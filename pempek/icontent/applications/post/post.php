<?php
defined('_iEXEC') or die();
?>
			<article id="content">
				<div class="wrap">
					<div class="box">
						<div>
                        <?php
set_layout('left');
$view		= call('view');
global $iw, $db;
switch( $view ){
default:
echo'<h2 class="letter_spacing">Blog <span>News</span></h2>';
$limit		= 10;
$a			= new paging();
$q			= $a->query( "SELECT * FROM `".$iw->pre."post` WHERE type='post' AND status=1 ORDER BY date_post DESC", $limit);
$jml_baris 	= $db->num($q);
for($i = 0; $i < $jml_baris; $i++){ 
$data 		= $db->fetch_array($q);
$topic 		= $data['post_topic'];
$id			= $data['id'];

$q1			= $db->query("SELECT * FROM ".$iw->pre."post_comment WHERE post_id='$id' and approved=1");
$totalres	= $db->num($q1); 
$q2			= $db->query("SELECT * FROM ".$iw->pre."post_topic WHERE id=".$topic);
$row		= $db->fetch_array($q2);
$post_img	= '';
if(file_exists(Upload.'post/'.$data['thumb'])&&!empty($data['thumb']))
$post_img	= '<img src="'.$iw->base_url . 'icontent/uploads/post/'.$data['thumb'].'" class="post-img">';
?>
<h1 class="bg"><?php _e($data['title']);?></h1>
<div class="post" id="post-1">
<?php _e($post_img);?>
<p style="text-align:justify;"><?php _e(limittxt(strip_tags($data['content']),450));?></p></div>

<?php $datas = array('view'=>'item','id'=>$data['id'],'title'=>$data['title']);?>
<p class="post-footer">
<a href="<?php _e(do_links('post',$datas));?>" rel="bookmark" title="<?php echo $data['title'];?>" class="readmore">Baca Selengkapnya</a>	
<span class="comments">Klik (<?php _e($data['hits']);?>)</span>
<span class="comments">Komentar (<?php _e($totalres);?>)</span>
<span class="waktu_posting"><?php _e(datetimes($data['date_post'],false));?></span>	
<span class="category">Topik : 

<?php $datas = array('view'=>'category','id'=>$data['post_topic'],'title'=>$row['topic']);?>
<a href="<?php _e(do_links('post',$datas));?>"><?php _e($row['topic']);?></a>
</span>	
</p>
<?php
$no++;
}
//halaman navigasi
echo $a->pg( 'post' );
break;
case'item':
$id		= post_item_id('item',$_GET['id']);
$q		= $db->query("SELECT * FROM `".$iw->pre."post` WHERE id=$id AND type='post' AND status=1");
$hits   = 0;
$data   = $db->fetch_array($q);
if(empty($data['id'])){
	redirect();
}else{
$hits	= $data['hits'];
		  $db->query("UPDATE ".$iw->pre."post SET hits=$hits+1, date_update=NOW() WHERE type='post' AND id=$id");

if(function_exists('load_meta_news'))
load_meta_news($data['title'],$data['content'],$data['tags']);
?>
<h2 class="letter_spacing"><?php _e($data['title']);?></h2>
<div class="border">
<div style="width:60%; float:left;">
<?php _e(datetimes($data['date_post']));?> - by : <?php _e($data['user_login']);?></div>
<div style="width:15%; float:right;" align="right">
<a href="javascript:void(window.open('<?php _e($iw->base_url);?>irequest.php?load=print&app=post&id=<?php _e($data['id']);?>','Print','scrollbars=yes,width=650,height=530'))">
<img src="<?php _e($iw->base_url);?>icontent/images/printButton.png" alt="print" height="16"/>
</a> 
<a href="#">
<img src="<?php _e($iw->base_url);?>icontent/images/emailButton.png" alt="send" height="16"/></a> 
<a href="#">
<img src="<?php _e($iw->base_url);?>icontent/images/pdf_button.png" alt="pdf"  height="16"/>
</a>
</div>
<br />
</div>
<!--
<div class="border" style="height:30px;"><img src="<?php //echo get_gravatar($data['mail']);?>" style="float:left; height:30px; width:30px; margin-right:2px;"/><?php //echo datetimes($data['date']);?> - oleh : <?php //echo $data['author'];?></div>
-->
<?php
$post_img='';
if(file_exists( Upload.'post/'.$data['thumb'])&&!empty($data['thumb']))
$post_img='<img src="'.$iw->base_url.'icontent/uploads/post/'.$data['thumb'].'" class="post-img-item">';
_e($post_img);
?>
<div class="post-item">
<?php _e($data['content']);?>
</div>
<?php
$titlenya	= $data['title'];
$id			= $data['id'];
$datas		= array('view'=>'item','id'=>$id,'title'=>$titlenya);
$id_link	= do_links('post',$datas);
$id 		= $data['id'];
$topic 		= $data['post_topic'];

//plugins
if(function_exists('load_sexybookmarks'))
_e( load_sexybookmarks() );
?>
<div class=border><strong>Label : </strong>
<?php 
if(function_exists('tags')) echo implode(', ',tags($id));
?>
</div>
<h1 class=border>Postingan Lainnya :</h1><div class=border>
<?php
/*
 *show post more where != id post and status = 1 and id topic  order by date asc limit 10
 */
$q		= $db->query("SELECT * FROM ".$iw->pre."post WHERE type='post' AND status=1 AND id!='$id' and post_topic='$topic' ORDER BY date_post ASC LIMIT 10" );
?>
<table cellspacing="1" cellpadding="1" width="100%">
<?php
$respon		= 0;
while ($data= $db->fetch_array($q)) {
$respon		= 1;
$id2    	= $data[0];
$titlemore  = $data['title'];
$datas		= array('view'=>'item','id'=>$id2,'title'=>$titlemore);
?>
<tr><td>
<img src="<?php echo $iw->base_url;?>icontent/images/1.gif" border="0" alt="ul" />
<a href="<?php echo do_links('post',$datas);?>"><?php echo limittxt($titlemore,123);?></a>
</td></tr>
<?php
}
if(!$respon){
?>
<tr><td>Kosong</td></tr>
<?php
}
?>
</table></div>
<?php
if( get_option('post_comment') == 1 ):
/*
 *show comment where id post and status = 1 order by id desc limit where data limit table id_comment_set
 */

$color			= '';
$comment_no		= 0;
$qry_comment	= $db->select("post_comment",array('post_id'=>$id,'approved'=>1,'comment_parent'=>0)); 

echo '<h1 class=border>'.count_comment($id).' Respon dari "'.$titlenya.'"</h1>';

if(count_comment($id) == 0)
echo '<div class=border>Belum ada komentar</div>';

while ($data	= $db->fetch_array($qry_comment)) {
	
$color 			= empty ($color) ? ' bgcolor="#fcfcfc"' : '';
$no_comment 	= filter_int( $data['comment_id'] );
$no_respon  	= filter_int( $comment_no++ );
//?com=post&view=item&id=1&reply=10
$data_reply		= array('view'=>'item','reply'=>$no_comment,'id'=>$id,'title'=>$titlenya);
$reply_link		= do_links('post',$data_reply);

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class=border id="respon-<?php echo $no_respon;?>" <?php echo $color;?>>
  <tr>
    <td width="91%" align="left" valign="top"><strong><a href="<?php echo $data['website'];?>"><?php echo $data['author'];?></a> berkata:</strong></td>
    <td width="9%" rowspan="3" align="right" valign="top"><img src="<?php _e(get_gravatar($data['email']));?>" alt="" width="30"/></td>
  </tr>
  <tr>
    <td align="left" valign="top"><a href="#respon-<?php echo $no_respon;?>"><?php echo datetimes($data['date']);?></a></td>
  </tr>
  <tr>
    <td colspan="2" align="left" valign="top">
	<?php echo set_link($data['comment']);?>
    <br />
</td>
  </tr>
</table>
<!--comment reply-->
<?php
$color2				= '';
$comment_no_reply	= 0;
$q2					= $db->select("post_comment",array('post_id'=>$id,'approved'=>1,'comment_parent'=>$no_comment)); 
while ($data2		= $db->fetch_array($q2)) {
$no_respon_reply	= filter_int( $comment_no_reply++ );
$color2 			= empty ($color2) ? ' bgcolor="#fcfcfc"' : '';
?>
<table style="margin-left:30px; width:550px; float:right;" border="0" cellspacing="0" cellpadding="0" class=border id="respon-<?php echo $no_respon;?>-<?php echo $no_respon_reply;?>" <?php echo $color2;?>>
  <tr>
    <td width="91%" align="left" valign="top"><strong><a href="<?php echo $data2['website'];?>"><?php echo $data2['author'];?></a> berkata:</strong></td>
    <td width="9%" rowspan="3" align="right" valign="top"><img src="<?php _e(get_gravatar($data2['email']));?>" alt="" width="30"/></td>
  </tr>
  <tr>
    <td align="left" valign="top"><a href="#respon-<?php echo $no_respon;?>-<?php echo $no_respon_reply;?>"><?php echo datetimes($data2['date']);?></a></td>
  </tr>
  <tr>
    <td colspan="2" align="left" valign="top"><?php echo set_link($data2['comment']);?></td>
  </tr>
</table>
<?php
}
?>
<!--comment reply-->
<a href="<?php echo $reply_link?>#respon-comment" class="post_reply">Reply &darr;</a>
<?php
}

?>
<br />
<?php if(isset($_GET['reply'])): ?>
<div align="right"><a href="<?php echo $id_link?>#respon-comment" class="post_reply">New Comment</a></div>
<?php endif;?>

<h1 class=border>Tinggalkan Komentar <?php if(isset($_GET['reply'])) _e('Balasan')?> 
</h1>
<?php

if(isset($_POST['addcomment'])){

if(!post_user_login())
{
	$author		= filter_txt($_POST['name']);
	$email 		= filter_txt($_POST['email']);
}
else
{
	$field 		= get_user_post();
		
	$user 		= $field['user_login'];
	$email 		= $field['user_email'];
	$author		= $field['user_author'];
}

	$comment 	= filter_txt($_POST['comment']);
	$comment 	= nl2br($comment);
	$approved	= get_option('post_comment_filter');
	$gfx_check  = filter_txt($_POST['gfx_check']);
	$reply	    = filter_int($_GET['reply']);
	$post_id    = filter_int($id);
	
	$data 		= compact('user','author','email','comment','date','approved','gfx_check','reply','post_id');
	set_comment($data);

}
?>
<div class="border" id="respon-comment">
<form method="post" action="#respon" id=respon>
  <table width="100%" border="0" cellspacing="2" cellpadding="0">
  <?php
  if(!post_user_login())
  {
  ?>
    <tr>
      <td width="15%" valign="top">Nama*</td>
      <td width="1%" valign="top"><strong>:</strong></td>
      <td width="74%" valign="top"><input class=input type="text" name="name"></td>
    </tr>
    <tr>
      <td valign="top">Mail*</td>
      <td valign="top"><strong>:</strong></td>
      <td valign="top"><input class=input type="text" name="email"></td>
    </tr>
    <?php
  }
  else
  {
	$field 	= get_user_post();
	?>   
    <tr>
      <td colspan="3" valign="top">Logged in as <a href="?login&go=profile"><?php echo $field['user_login']?></a>. <a href="?login&go=logout"  onclick="return confirm('Are You sure logout?')">Log out?</a></td>
      </tr>
    <tr>
      <td colspan="3" valign="top">&nbsp;</td>
      </tr>
    <?php
  }
	?>
    <tr>
      <td valign="top">Komentar*</td>
      <td valign="top"><strong>:</strong></td>
      <td valign="top"><textarea  cols="50" rows="5" name="comment"></textarea></td>
    </tr>
    <tr>
      <td valign="top">Kode Keamanan*</td>
      <td valign="top"><strong>:</strong></td>
      <td valign="top"><img src='<?php if(function_exists('load_captcha')){ _e(load_captcha());}?>'  style="border:1px solid #999"></td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td valign="top"><input  name="gfx_check" type="text" size=10/></td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td valign="top"><input class=button type="submit" name="addcomment" value="Kirim"></td>
    </tr>
  </table>
</form>
</div>
<?php
endif;
}

	break;
	case'category':
$id			= post_item_id('category',$_GET['id']);
$qry		= $db->select("post_topic",array('id'=>$id));
$data_topic	= $db->fetch_array($qry);
echo'<h1 class=border>Topik : '.$data_topic['topic'].'</h1>';

$limit		= 10;
$a			= new paging();
$qry_post	= $a->query("SELECT * FROM `".$iw->pre."post` WHERE type='post' AND post_topic='".$id."' AND status=1 ORDER BY date_post DESC", $limit);

if($db->num($qry_post) < 1) redirect();

while($data_post = $db->fetch_array($qry_post)){
$post_id		 = $data_post['id'];
$qry_comment	 = $db->select("post_comment",array('post_id'=>$post_id,'approved'=>1)); 


$post_img='';
if(file_exists( Upload.'post/'.$data_post['thumb'])&&!empty($data_post['thumb']))
$post_img='<img src="'. $iw->base_url.'icontent/uploads/post/'.$data_post['thumb'].'" class="post-img">';
?>
<h1 class="bg"><?php echo limittxt($data_post['title'],55);?></h1>
<div class="post" id="post-1">
           <?php echo $post_img;?>
           <p style="text-align:justify;"><?php echo limittxt(strip_tags($data_post['content']),450);?></p>
        </div>
<p class="post-footer">	
	
<?php $datas = array('view'=>'item','id'=>$post_id,'title'=>$data_post['title']);?>			
<a href="<?php echo do_links('post',$datas);?>" rel="bookmark" title="<?php echo $data_post['title'];?>" class="readmore">Baca Selengkapnya</a>
<span class="comments">Klik (<?php echo $data_post['hits'];?>)</span>
<span class="comments">Komentar (<?php _e($db->num($qry_comment));?>)</span>
<span class="waktu_posting"><?php echo datetimes($data_post['date_post'],false);?></span>	
</p>
<?php
$no++;
}
//halaman navigasi
echo $a->pg('post',array('view'=>'category','id'=>$_GET['id']));

break;
case'tags':
$tags 		= filter_txt($_GET['id']);
$limit		= 10;
$a			= new paging();
if (!empty($tags)){
$tag = mysql_escape_string($tags);?>
<h1 class="border">Arsip : <?php echo str_replace('+',' ',stripslashes(strip_tags($tags)));?></h1>
<?php			
if (strlen($tag) == 3) {
	$finder = "`tags` LIKE '%$tag%'";
}else {
	$finder = "MATCH (tags) AGAINST ('$tag' IN BOOLEAN MODE)";
}}
$q			= $a->query( "SELECT * FROM `".$iw->pre."post` WHERE  $finder AND type='post' AND status=1 ORDER BY date_post", $limit);
$jml_baris  = $db->num($q);
if($jml_baris<=0){			
	redirect();
}
for($i = 0; $i < $jml_baris; $i++){ 
$data 	= $db->fetch_array($q);
$post_id= $data['id'];
$topic 	= $data['post_topic'];

$q2		= $db->query("select * from ".$iw->pre."post_comment where 	post_id='$post_id' and approved=1"); 
$totalres=$db->num($q2);
$q3		= $db->query("SELECT * FROM ".$iw->pre."post_topic ORDER BY id=$topic");
while ($data_t 	= $db->fetch_array($q3)) {
$topic_id		= $data_t['id'];
$topic_title	= $data_t['topic'];
}
$post_img='';
if(file_exists( Upload.'post/'.$data['thumb'])&&!empty($data['thumb']))
$post_img='<img src="'. $iw->base_url. 'icontent/uploads/post/'.$data['thumb'].'" class="post-img">';
?>
<h1 class="bg"><?php echo limittxt($data['title'],55);?></h1>
<div class="post" id="post-1">
           <?php echo $post_img;?>
           <p style="text-align:justify;"><?php echo limittxt(strip_tags($data['content']),450);?></p>
        </div>
<p class="post-footer">	

<?php $datas = array('id'=>$data['id'],'view'=>'item','title'=>$data['title']);?>				
<a href="<?php echo do_links('post',$datas);?>" rel="bookmark" title="<?php echo $data['title'];?>" class="readmore">Baca Selengkapnya</a>
<span class="comments">Klik (<?php echo $data['hits'];?>)</span>
<span class="comments">Komentar (<?php _e($totalres);?>)</span>
<span class="waktu_posting"><?php _e(datetimes($data['date_modif'],false));?></span>	

<?php $datas = array('view'=>'category','id'=>$topic_id,'title'=>$topic_title);?>	
<span class="category">Topik : <a href="<?php _e(do_links('post',$datas));?>"><?php _e($topic_title);?></a></span>	
</p>
<?php
$no++;
}
//halaman navigasi
echo $a->pg( 'post',array('view'=>'tags','id'=>$tags) );
	break;
}
?>
</div>
					</div>
				</div>
			</article>
		</div>
	</div>
</div>
<div class="body2">
	<div class="main">
		<article id="content2">
			<div class="wrapper">
				<section class="pad_left1">
					<div class="wrapper">
						<div class="cols">
							<h2>Our Contacts</h2>
						</div>
						<div class="col3 pad_left1">
							<h2>Miscellaneous Info</h2>
						</div>
					</div>
					<div class="line1">
						<div class="wrapper line2">
							<div class="cols">
								<div class="wrapper pad_bot1">
									<p>Sed ut perspiciatis unde omnis iunatus doloremque laudantium.</p>
									<p class="address">
										Marmora Road, Glasgow, D04 89GR.<br>
										<span>Freephone:</span>    +1 800 559 6580<br>
										<span>Telephone:</span>    +1 959 603 6035<br>
										<span>E-mail:</span>             <a href="mailto:">mail@demolink.org</a>
									</p>
								</div>
							</div>
							<div class="col3 pad_left1">
								<p>
									Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
								</p>
								Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error.
							</div>
						</div>
					</div>
				</section>
			</div>
		</article>
