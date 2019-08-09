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

<div class="box-head dotted">Contact Message</div>
<div id="box-content">
<?php
global $iw,$db;

$go 	= filter_txt($_GET['go']);
$act	= filter_txt($_GET['act']);
$id 	= filter_int($_GET['id']);

$widget = array(
'menu'		=> menu(),
'help_desk' => 'Memungkinkan anda mengecek serta mengirim pesan dari contact message'
);

switch($go){
default:
if($act=='del'){    
	del_contact_message(compact('id'));  
}
$limit		= 10;
$a			= new paging_admin();
if($act=='inbox') $add_query='WHERE `inbox`=1';
if($act=='senditem') $add_query='WHERE `outbox`=1';
$q			= $a->query( "SELECT * FROM `".$iw->pre."contact` $add_query ORDER BY date DESC", $limit);
?>
<table id=table cellpadding="0" cellspacing="0">
<tr class="head">
    <td width="13%" class="depan"><strong>From</strong></td>
    <td width="23%" class="depan"><strong>Date</strong></td>
    <td width="10%" class="depan"><center><strong>Status</strong></center></td>
	<td width="43%" class="depan"><strong>Subject</strong></td>
    <td class="depan"><div align="center"><strong>Action</strong></div></td>
  </tr>
<?php
$warna = '';
while ($data = $db->fetch_array($q)) {
$id 	= $data['id'];
$subject= $data['subject'];
$email 	= $data['email'];
$warna 	= empty ($warna) ? ' bgcolor="#f1f6fe"' : '';
$bgread	='style="background:#ffffeb"';
$bgread = (empty($data['read'])) ? 'style="background:#ffffeb"' : '';
$read 	= (empty($data['read'])) ? 'U' : 'R';
?>
<tr <?php _e($warna)?> class="isi" <?php _e($bgread)?>>
	<td valign="top"><span title="<?php _e($email)?>"><?php _e( set_name_mail($email) )?></span></td>
	<td valign="top"><?php _e( datetimes($data['date'],false) )?></td>
	<td valign="top"><center><?php _e( $read )?></center></td>
	<td valign="top">
    <?php if( !empty($subject) ){
		  _e( limittxt($subject,120) );
		}else{
		  _e( limittxt($data['message'],120) );
		}?>
    </td>
    <td valign="top">
    <div align="center">
<a href="?admin&apps=contact&go=read&id=<?php _e($id)?>" class="view" title="view">view</a>
<a href="?admin&apps=contact&act=del&id=<?php _e($id)?>" class="delete" title="delete" onclick="return confirm('Are You sure delete this message?')">delete</a>
    </div></td>
</tr>
<?php
}
?>
</table>
<!--halaman navigasi-->
<div id="num">
<?php _e($a->pg('?admin&apps=contact'));?>
</div>
<?php
break;
case'read':

last_read_message( array('read'=>1),compact('id') );

if(isset($_POST['submit'])){
	$email 	 = filter_txt($_POST['email']);
	$subject = filter_txt($_POST['subject']);
	$message = $_POST['message'];
	$outbox  = 1;
	
	$data = compact('email','subject','message','outbox');
	update_resend_message($data,compact('id'));
}

$q		= $db->select( "contact",compact('id') );
$data	= $db->fetch_array($q);
?>
<form action="" method="post" enctype="multipart/form-data" name="form1">
    <table width="100%" border="0" cellpadding="0" cellspacing="2">
     <tr>
        <td width="4%" align="right">To</td>
        <td width="1%"><strong>:</strong></td>
        <td width="95%"><label>
         <input  class="input" type="text" name="email" value="<?php _e($data['email'])?>" style="width:200px;"/>
        </label></td>
      </tr>
      <tr>
        <td width="4%" align="right">Subject</td>
        <td width="1%"><strong>:</strong></td>
        <td width="95%"><label>
         <input  class="input" type="text" name="subject" value="<?php _e($data['subject'])?>" style="width:300px;""/>
        </label></td>
      </tr>
      <tr>
        <td align="right" valign="top">Message</td>
        <td valign="top"><strong>:</strong></td>
        <td>
        <textarea id="editor" name="message" style="width:100%; height:200px;">
        <br />
        <span style="color: #999999; font-size:11px;">&lt;--this your message reply--&gt;</span>
        <br />
        --------------------------------------------------------------------------------
        <br>
        <?php _e( htmlspecialchars(@$data['message']) );?>
        </textarea></td>
      </tr>
	  <tr>
        <td></td>
        <td></td>
        <td>
<button name="submit" class="primary"><span class="icon mail"></span>Send</button> or <button name="Reset"><span class="icon loop"></span>Reset</button>
		</td>
      </tr>
    </table>
    </form>
<?php
break;
case'new':
if(isset($_POST['submit'])){
	$email 	 = filter_txt($_POST['email']);
	$subject = filter_txt($_POST['subject']);
	$message = $_POST['message'];
	$outbox  = 1;
	
	$data = compact('email','subject','message','outbox');
	insert_send_message($data);
}

?>
<form action="" method="post" enctype="multipart/form-data" name="form1">
    <table width="100%" border="0" cellpadding="0" cellspacing="2">
     <tr>
        <td width="4%" align="right">To</td>
        <td width="1%"><strong>:</strong></td>
        <td width="95%"><label>
         <input  class="input" type="text" name="email" style="width:200px;"/>
        </label></td>
      </tr>
      <tr>
        <td width="4%" align="right">Subject</td>
        <td width="1%"><strong>:</strong></td>
        <td width="95%"><label>
         <input  class="input" type="text" name="subject" style="width:300px;""/>
        </label></td>
      </tr>
      <tr>
        <td align="right" valign="top">Message</td>
        <td valign="top"><strong>:</strong></td>
        <td>
        <textarea id="editor" name="message" style="width:100%; height:200px;"></textarea>
        </td>
      </tr>
	  <tr>
        <td></td>
        <td></td>
        <td>
<button name="submit" class="primary"><span class="icon mail"></span>Send</button> or <button name="Reset"><span class="icon loop"></span>Reset</button>
		</td>
      </tr>
    </table>
    </form>
<?php
break;
}
?>
</div>
