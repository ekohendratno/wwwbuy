<?php
/**
 * @file manage.php
 *
 */
//dilarang mengakses
defined('_iEXEC') or die();

require_once('init.php');
?>
<!--Manage Layout-->

<link href="icontent/applications/post/style-users.css" rel="stylesheet" media="screen" type="text/css" />
<div class="box-head dotted">Posting Manager</div>
<div id="box-content">
<?php
global $iw,$db;
$go 	= filter_txt($_GET['go']);
$act	= filter_txt($_GET['act']);
$type	= filter_txt($_GET['type']);
$pub	= filter_txt($_GET['pub']);
$id 	= filter_int($_GET['id']);
$reply 	= filter_int($_GET['reply']);
$offset	= filter_int($_GET['offset']);

$widget = array(
'menu'		=> menu(),
'help_desk' => 'Memungkinkan anda menambahkan beberapa artikel maupun halaman ke website anda dengan mudah'
);

switch($go){
default:
if(!empty($act))
if($act == 'pub'){
	if ($pub == 'no') $stat =0;	
	if ($pub == 'yes') $stat =1;
	update_pub_post(array('status'=>$stat),$id);
}
if($act == 'del'){    
	del_post(compact('id'));  
}
$limit		= 10;
$a			= new paging_admin();
if($type=='page'){
	$add_query	='WHERE `type`="page"';
	$type		='&type=page';
}else{
	$add_query	='WHERE `type`="post"';
	$type		= '';
}
$q			= $a->query( "SELECT * FROM `".$iw->pre."post` $add_query ORDER BY id DESC", $limit);
?>
<table id=table cellpadding="0" cellspacing="0">
<tr class="head">
    <td width="2%" class="depan"><strong>ID</strong></td>
    <td width="73%" class="depan"><strong>Title</strong></td>
    <td class="depan"><div align="center"><strong>Status</strong></div></td>
    <td class="depan"><div align="center"><strong>Action</strong></div></td>
  </tr>
<?php
$warna = '';
while ($data = $db->fetch_array($q)) {
$id 	= $data['id'];
$warna 	= empty ($warna) ? ' bgcolor="#f1f6fe"' : '';
$status = ($data['status'] == 1) ? '<a  class="enable" title="Enable" href="?admin&apps=post'.$type.'&act=pub&pub=no&id='.$id.'">Enable</a>' : '<a  class="disable" title="Disable" href="?admin&apps=post'.$type.'&act=pub&pub=yes&id='.$id.'">Disable</a>';

?>
<tr <?php _e($warna)?> class="isi">
	<td valign="top" align="right"><?php _e($data['id'])?></td>
	<td valign="top"><span title="<?php _e($data['title'])?>"><?php _e($data['title'])?></span></td>
	<td valign="top"><div align="center"><?php _e($status)?></div></td>
    <td valign="top">
    <div align="center">
<a href="?admin&apps=post&go=read&id=<?php _e($id)?>" class="view" title="view">view</a>
<a href="?admin&apps=post&go=edit<?php _e($type)?>&id=<?php _e($id)?>" class="edit" title="edit">edit</a>
<a href="?admin&apps=post&act=del&id=<?php _e($id)?>" class="delete" title="delete" onclick="return confirm('Are You sure delete this post?')">delete</a>
    </div></td>
</tr>
<?php
}
?>
</table>
<!--halaman navigasi-->
<div id="num">
<?php _e($a->pg('?admin&apps=post'.$type));?>
</div>
<div class=num style="height:24px;">
<div class="right">
<a href="?admin&apps=post&go=add" class="button primary">Add Post</a>
<a href="?admin&apps=post&go=addcat" class="button">Add Category</a>
</div>
</div>
<?php
break;
case'read':
$row = view_post( $id );
echo '<div style="overflow:auto; max-height:400px;"';
echo '<p><b>'.$row['title'].'</b><br>';

$post_img	= '';
if(file_exists(Upload.'post/'.$row['thumb'])&&!empty($row['thumb']))
$post_img	= '<img src="'.$iw->base_url . 'icontent/uploads/post/'.$row['thumb'].'" 
style="
	float				:left;
	max-height			:260px;
	max-width			:260px;
	margin-right		:5px;
	padding				:2px
">';

echo $post_img.$row['content'].'</p>';
echo '</div>';
break;
case'add':
if(isset($_POST['submit']) || isset($_POST['draf'])){
	$title 		= filter_txt($_POST['title']);
	$category 	= filter_int($_POST['category']);
	$type 		= filter_txt($_POST['type']);
	
	if(get_option('text_editor')=='classic')
	$isi	 	= nl2br2($_POST['isi']);
	else
	$isi	 	= $_POST['isi'];
	
	$tags 		= filter_txt($_POST['tags']);
	$date 		= filter_txt($_POST['date']);
	$thumb	 	= $_FILES['thumb'];
	
	if(isset($_POST['draf'])) $status = 0;
	else $status = 1;
	
	$data = compact('title','category','type','isi','thumb','tags','date','status');
	add_post($data);
}
?>
<form method="post" action="" enctype="multipart/form-data">
		  <table width="100%" border="0" cellspacing="2" cellpadding="0">
			<tr>
			  <td align="right">Title :</td>
			  <td>
			  <input type="text" name="title" style="width:500px" ></td>
			</tr>
			<tr>
			  <td align="right">Type :</td>
			  <td>
               
                                    <select name="type"> 
                                        <option value="">Pilih Type Postingan</option> 
                                        <option value="post">Post</option> 
                                        <option value="page">Page</option> 
                                    </select> 
			</td>
			</tr>
			<tr>
			  <td align="right">Category :</td>
			  <td>
               
                                    <select name="category"> 
                                        <option value="">Pilih Category</option> 
                                        <?php list_category()?>
                                    </select>  *( 
			</td>
			</tr>
            <tr>
              <td align="right" valign="top">Content :</td>
			  <td>
			  <textarea name="isi" id="editor" style="width:600px; height:250px"></textarea></td>
			</tr>
			<tr>
			  <td align="right">&nbsp;</td>
			  <td>
              <input type="file" name="thumb"> 
              </td>
		    </tr>
			<tr>
			  <td align="right">Tags :</td>
			  <td>
			  <input type="text" name="tags" style="width:300px;"> *(</td>
			</tr>
			<tr>
			  <td align="right">DT :</td>
			  <td>
			  <input type="text" name="date" value="<?php _e(date('Y-m-d H:i:s'))?>"> Now Time : <?php _e(datetimes(date('Y-m-d H:i:s')))?></td>
			</tr>
			<tr>
			  <td></td>
			  <td>*( : jika type posting {page} option ini diabaikan</td>
			</tr>
			<tr>
			  <td>&nbsp;</td>
			  <td><button name="submit" class="primary"><span class="icon plus"></span>Add</button> or 
			  <button name="draf">Save as Draf</button> <button name="Reset">Clear All</button></td>
			</tr>
		  </table>
</form>
<?php
break;
case'edit':
if(isset($_POST['submit'])){
	$title 		= filter_txt($_POST['title']);
	$category 	= filter_int($_POST['category']);
	if(get_option('text_editor')=='classic'){
	$isi	 	= nl2br2($_POST['isi']);
	}else{
	$isi	 	= $_POST['isi'];
	}
	$tags 		= filter_txt($_POST['tags']);
	$date 		= filter_txt($_POST['date']);
	$thumb	 	= $_FILES['thumb'];
	
	$data = compact('title','category','isi','thumb','tags','date');
	update_post($data,$id); 
}
$row = view_post( $id );
?>
<form method="post" action="" enctype="multipart/form-data">
		  <table width="100%" border="0" cellspacing="2" cellpadding="0">
			<tr>
			  <td align="right">Title :</td>
			  <td>
			  <input type="text" name="title" style="width:500px" value="<?php _e($row['title'])?>"></td>
			</tr>
            <?php if($type!='page'):?>
			<tr>
			  <td align="right">Category :</td>
			  <td>
               
                                    <select name="category"> 
                                        <option value="">Pilih Category :</option> 
                                        <?php list_category($row['post_topic'])?>
                                    </select>  *( 
			</td>
			</tr>
            <?php endif;?>
            <tr>
              <td align="right" valign="top">Content :</td>
			  <td>
			  <textarea name="isi" id="editor" style="width:600px; height:250px"><?php _e($row['content'])?></textarea></td>
			</tr>  
			<tr>
			  <td align="right">&nbsp;</td>
			  <td>
              <input type="file" name="thumb">
              </td>
		    </tr>
             <?php if($type!='page'):?>          
			<tr>
			  <td align="right">Tags :</td>
			  <td>
			  <input type="text" name="tags" style="width:300px;" value="<?php _e($row['tags'])?>"> *(</td>
			</tr>
            <?php endif;?>
			<tr>
			  <td align="right">DT Update :</td>
			  <td>
			  <input type="text" name="date" value="<?php _e(date('Y-m-d H:i:s'))?>"> Now Time : <?php _e(datetimes(date('Y-m-d H:i:s')))?></td>
			</tr>
			<tr>
			  <td></td>
			  <td>*( : jika type posting {page} option ini diabaikan</td>
			</tr>
			<tr>
			  <td>&nbsp;</td>
			  <td><button name="submit" class="primary"><span class="icon pen"></span>Save & Update</button> <button name="Reset">Clear All</button></td>
			</tr>
		  </table>
</form>
<?php
break;
case'category':
if($act == 'del'){    
	del_category_post(compact('id'));  
}
?>
<table id=table cellpadding="0" cellspacing="0">
<tr class="head">
    <td width="65%" class="depan"><strong>Title</strong></td>
    <td class="depan"><div align="center"><strong>Total Post</strong></div></td>
    <td colspan="2"><div align="center"><strong>Action</strong></div></td>
</tr>
<?php
$limit		= 10;
$a			= new paging_admin();
$q			= $a->query( "SELECT * FROM `".$iw->pre."post_topic` ORDER BY id DESC", $limit);
$warna 		= '';
while($data = $db->fetch_array($q)) {
$id 		= $data['id'];
$title 		= $data['topic'];
$q2			= $db->query("SELECT COUNT(*) AS jumNews FROM `".$iw->pre."post` WHERE post_topic='$id'");
$data2     	= $db->fetch_array($q2);
$jumNews 	= $data2['jumNews'];
$warna 		= empty ($warna) ? ' bgcolor="#f1f6fe"' : '';
?>
<tr <?php _e($warna)?> class="isi">
	<td><?php _e($title)?></td>
	<td><div align="center">( <?php _e($jumNews)?> )</div></td>
    <td>
    <div align="center">
<a href="?admin&apps=post&go=editcat<?php _e($type)?>&id=<?php _e($id)?>" class="edit" title="edit">edit</a>
<a href="?admin&apps=post&go=category&act=del&id=<?php _e($id)?>" class="delete" title="delete" onclick="return confirm('Are You sure delete this category post?')">delete</a>
    </div></td>
</tr>
<?php
}
?>
</table>
<!--halaman navigasi-->
<div id="num">
<?php _e($a->pg('?admin&apps=post&go=category'));?>
</div>
<div class=num style="height:24px;">
<div class="right">
<a href="?admin&apps=post&go=addcat" class="button">Add Category</a>
</div>
</div>
<?php
break;
case'addcat':
if(isset($_POST['submit'])){
	$title	= filter_txt($_POST['title']);
	$desc	= filter_txt($_POST['desc']);
	
	$data = compact('title','desc');
	add_category_post($data);
}
?>
<form action="" method="post" enctype="multipart/form-data" name="form1">
  <table width="100%" border="0" cellpadding="0" cellspacing="2">
    <tr>
      <td>Title</td>
    </tr>
	<tr>
      <td width="84%"><input type="text" name="title" style="width:400px;"></td>
    </tr>
    <tr>
      <td>Description</td>
    </tr>
    <tr>
      <td><textarea type="text" name="desc" style="width:90%; height:60px;"></textarea></td>
    </tr>
    <tr>
      <td><button name="submit" class="primary"><span class="icon plus"></span>Add</button> <button name="Reset">Clear All</button></td>
    </tr></table>
<?php
break;
case'editcat':
if(isset($_POST['submit'])){
	$title	= filter_txt($_POST['title']);
	$desc	= filter_txt($_POST['desc']);
	
	$data = compact('title','desc');
	update_category_post($data,$id);
}
$row = view_category_post( $id );
?>
<form action="" method="post" enctype="multipart/form-data" name="form1">
  <table width="100%" border="0" cellpadding="0" cellspacing="2">
    <tr>
      <td>Title</td>
    </tr>
	<tr>
      <td width="84%"><input type="text" name="title" style="width:400px;" value="<?php _e($row['topic'])?>"></td>
    </tr>
    <tr>
      <td>Description</td>
    </tr>
    <tr>
      <td><textarea type="text" name="desc" style="width:90%; height:60px;"><?php _e($row['desc'])?></textarea></td>
    </tr>
    <tr>
      <td><button name="submit" class="primary"><span class="icon pen"></span>Save & Update</button> <button name="Reset">Clear All</button></td>
    </tr></table>
<?php
break;
case'setting':
if(isset($_POST['submit'])){
	$text_editor 		= filter_txt($_POST['select_editor']);
	$post_comment 		= filter_int($_POST['comment']);
	$post_comment_filter= filter_int($_POST['comment_filter']);
	
	$data = compact('text_editor','post_comment','post_comment_filter');
	set_posting($data);
}
?>
<form action="" method="post" enctype="multipart/form-data" name="form1">
  <table width="100%">
    <tbody>
    <tr>
      <td valign="top" width="24%">Text Editor</td>
      <td valign="top" width="1%"><strong>:</strong></td>
      <td width="75%">
      <select name="select_editor">
      <optgroup label="Select Editor">
<?php
if(get_option('text_editor')=='wkrte'){
	_e('	
      <option value="tiny_mce">Tiny MCE</option>
      <option value="wkrte" selected="selected">Wkrte</option>
      <option value="classic">Classic</option>
	');
}elseif(get_option('text_editor')=='tiny_mce'){
	_e('	
      <option value="tiny_mce" selected="selected">Tiny MCE</option>
      <option value="wkrte">Wkrte</option>
      <option value="classic">Classic</option>
	');
}else{
	_e('	
      <option value="tiny_mce">Tiny MCE</option>
      <option value="wkrte">Wkrte</option>
      <option value="classic" selected="selected">Classic</option>
	');
}
?>
	  </optgroup>
      </select>
      </td>
    </tr>
    <tr>
      <td valign="top" width="24%">Comment</td>
      <td valign="top" width="1%"><strong>:</strong></td>
      <td width="75%">
      <select name="comment">
      <optgroup label="Select Status">
<?php
if(get_option('post_comment')==1){
	_e('	
      <option value="1" selected="selected">Enable</option>
      <option value="0">Disable</option>
	');
}else{
	_e('	
      <option value="1">Enable</option>
      <option value="0" selected="selected">Disable</option>
	');
}
?>
	  </optgroup>
      </select>
      </td>
    </tr>
    
    <tr>
      <td valign="top" width="24%">Comment Filter</td>
      <td valign="top" width="1%"><strong>:</strong></td>
      <td width="75%">
      <select name="comment_filter">
      <optgroup label="Select Status">
<?php
if(get_option('post_comment_filter')==1){
	_e('	
      <option value="1" selected="selected">Approve</option>
      <option value="0">Inaprove</option>
	');
}else{
	_e('	
      <option value="1">Approve</option>
      <option value="0" selected="selected">Inaprove</option>
	');
}
?>
	  </optgroup>
      </select>
      </td>
    </tr>
  </tbody></table>
<div class="num" style="text-align: left;">
<button name="submit" class="primary"><span class="icon pen"></span>Save & Update</button> or 
<button name="Reset"><span class="icon loop"></span>Reset</button>
</div></form>
<?php
break;
case'comment':
if($act == 'pub' && !empty($act)){
	if ($pub == 'no') $stat =0;	
	if ($pub == 'yes') $stat =1;
	
	$post_id 	= esc_sql($id);
	$comment_id = esc_sql($reply);
	
	update_comment(array('approved'=>$stat),compact('post_id','comment_id'));
}
if($act == 'del' && !empty($act)){
	if(!empty($id) && !empty($reply)):
	
	$post_id 	= esc_sql($id);
	$comment_id = esc_sql($reply);
	
	del_comment(compact('post_id','comment_id')); 
	endif;
}

if(isset($offset) && !empty($offset)) $limit = $offset;
else $limit	= 10;
$warna 		='';
$a			= new paging_admin();
$q			= $a->query('
SELECT * FROM '.$iw->pre.'post_comment 
LEFT JOIN '.	$iw->pre.'post 
ON '.			$iw->pre.'post.id = '.
				$iw->pre.'post_comment.post_id 
ORDER BY '.		$iw->pre.'post_comment.date DESC', $limit);
?>
<form method="post" action="">
<?php
echo js_redirec_list();
$selected	='';
if($offset==10){$sel1='selected="selected"';}
if($offset==30){$sel2='selected="selected"';}
if($offset==50){$sel3='selected="selected"';}
?>
<div class=num style="text-align:left">
Show :
<select onchange="redir(this)" name="show">
<option value="?admin&apps=post&go=comment&offset=10" <?php _e($sel1)?>>10</option>
<option value="?admin&apps=post&go=comment&offset=30" <?php _e($sel2)?>>30</option>
<option value="?admin&apps=post&go=comment&offset=50" <?php _e($sel3)?>>50</option>
</select>
</div>
<div id="list-comment">
<div class="mash-div"></div>
<?php
while($row = $db->fetch_array($q)){
$warna  = empty ($warna) ? 'style="background:#f1f6fe;"' : '';
?>
<div class="comment" <?php _e($warna)?>>
<img alt="" src="<?php _e( get_gravatar($row['email']))?>" class="avatar" height="50" width="50">
<div class="dashboard-comment-wrap">
<span class="name"><?php _e( uc_first($row['author']) )?></span><br />
<span class="title"><?php _e( uc_first($row['title']) )?></span><br />
<span class="date"><em><?php _e( datetimes($row['date']) )?></em></span><br />
<p class="comment-text">
<?php _e( limittxt($row['comment'],180) )?>		
<div class="row-actions">
<span class="edit">
<?php
if($row['approved']==1){
?>
<a href="?admin&apps=post&go=comment&act=pub&pub=no&id=<?php _e($row['id'])?>&reply=<?php _e($row['comment_id'])?>">Unapprove</a>
<?php
}else{
?>
<a href="?admin&apps=post&go=comment&act=pub&pub=yes&id=<?php _e($row['id'])?>&reply=<?php _e($row['comment_id'])?>">Approved</a>
<?php
}
?>
</span>
<span class="edit"> | 
<?php if(isset($act) && !empty($act) && $act=='reply' && $row['comment_id']==$reply){?>
<a href="?admin&apps=post&go=comment&id=<?php _e($row['id'])?>&reply=<?php _e($row['comment_id'])?>">Cencel Reply</a>
<?php }else{?>
<a href="?admin&apps=post&go=comment&act=reply&id=<?php _e($row['id'])?>&reply=<?php _e($row['comment_id'])?>">Reply</a>
<?php }?>
</span>
<span class="trash"> | <a href="?admin&apps=post&go=comment&act=del&id=<?php _e($row['id'])?>&reply=<?php _e($row['comment_id'])?>"  onclick="return confirm('Are You sure delete this comment?')">Trash</a></span><br />
<?php if(isset($act) && !empty($act) && $act=='reply' && $row['comment_id']==$reply){
if(isset($_POST['submit'])) {
	$comment	= filter_txt($_POST['reply_comment']);
	$comment 	= nl2br2($comment);
	
	set_comment(compact('comment','id','reply'));
}
?>
<textarea name="reply_comment" style="width:687px; min-height:15px" class="grow"></textarea>
<div style="margin-top:2px;">
<button name="submit" class="primary">Reply</button> <button name="Reset">Clear All</button>
</div>
<?php }?>
</div>
</p>	
</div>
</div>
<?php
}
?>
</div>
<!--halaman navigasi-->
<div id="num">
<?php _e($a->pg('?admin&apps=post&go=comment&offset='.$offset));?>
</div>

</form>
<?php
break;

}
?>
</div>
