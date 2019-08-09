<?php
/*
App Name: Contact
App URI: http://cmsid.org/#
Description: Contact Apps
Author: Eko Azza
Version: 1.1.1
Author URI: http://cmsid.org/#
*/ 

//dilarang mengakses
if(!defined('_iEXEC')) exit;
global $db, $login;

ob_start();
?>
<div class="clear"></div>
<div class="border">
<?php
global $db;
if (isset($_POST['submit'])) {
	
$youemail = filter_txt($_POST['email']);
$message = nl2br2(filter_txt($_POST['pesan']));
$security_code_check = filter_txt($_POST['security_code_check']);
$security_code = filter_txt($_SESSION['security_code']);

$error 	= '';
if (!valid_mail($email)) $error .= "Format Mail tidak benar<br />";
if (!$message) $error .= "Pesan kosong<br />";

if ( security_posted('contact', true ) > 0 ) 
	$error .= "Anda telah mengirimkan pesan, tunggu beberapa menit lagi<br />";
	
if($security_code_check != $security_code or !isset($security_code) )
	$error .= "Kode keamanan salah<br />";

if ($error) { ?>
<div class="div_alert"><?php echo $error;?></div>
<?php
}else{
	
$subject 	= "Form kontak ".get_option('sitename');
$pesan 		= "Form kontak<br>Mail: $email <br>Pesan: <br>$message";
$date 		= date('Y-m-d H:i:s');
$inbox 		= 1;

//$db->insert("contact", compact('email','message','date','inbox') );

mail_send($youemail, $subject, $pesan);

?>
<div class="div_info">Pesan kontak telah dikirim</div>
<?php
}}

?>
<form method="post" action="">
<table border="0"  cellpadding="0" cellspacing="4" width="100%">
  <tr>
    <td width="10%" align="right" valign="top">Mail</td>
    <td width="1%" valign="top">:</td>
    <td width="89%" valign="top"><input class='input' type="text" name="email"  size="25"/></td>
  </tr>
  <tr>
    <td valign="top" align="right">Pesan</td>
    <td valign="top">:</td>
    <td valign="top"><textarea class='textarea' name="pesan"  cols="40" rows="5"></textarea></td>
  </tr>
  <tr>
    <td valign="top" align="right">Anti Spam</td>
    <td valign="top">:</td>
    <td valign="top"><img src="<?php echo site_url('?request&load=libs/captcha/random.php')?>"  style="border:1px solid #999;margin-top:2px;"></td>
  </tr>
  <tr>
    <td valign="top"></td>
    <td valign="top"></td>
    <td valign="top"><input class='input' name='security_code_check' type='text' size=10/></td>
  </tr>
  <tr>
    <td valign="top"></td>
    <td valign="top"></td>
    <td valign="top"></td>
  </tr>
  <tr>
    <td valign="top"></td>
    <td valign="top"></td>
    <td valign="top"><input class=button type="submit" name="submit" value="Kirim" /></td>
  </tr>
</table>
</form>

</div>
<?php
$dl = ob_get_contents();
ob_end_clean();

add_the_content_view( (object) array('view' => 'apps','title' => 'Contact Us', 'content' => $dl) );