<?php 
defined('_iEXEC') or die();

global $db;
set_layout('full');

?>
			<article id="content">
				<div class="wrap">
					<div class="box">
						<div>
							<h2 class="letter_spacing">Contact <span>Form</span></h2>
                            <?php
global $iw,$db;
if (isset($_POST['submit'])) {
$email 	= filter_txt($_POST['email']);
$message 	= nl2br2(filter_txt($_POST['pesan']));
$error 	= '';
if (!valid_mail($email)) 	$error .= "Format Mail tidak benar<br />";
if (!$message) 				$error .= "Pesan kosong<br />";
if (cek_post('contact')!=0)	$error .= "Anda telah mengirimkan pesan, tunggu beberapa menit lagi<br />";
if ($_POST['gfx_check'] != $_SESSION['Var_session'] or !isset($_SESSION['Var_session'])) {
							$error .= "Kode keamanan salah<br />";
}
if ($error) {
?>
<div class="div_alert"><?php echo $error;?></div>
<?php
}else{
$subject 	= "Form kontak ".get_option('web_title');
$pesan		= "Form kontak<br>Mail: $email <br>Pesan: <br>$message";
$date		= date('Y-m-d H:i:s');
$inbox		= 1;

$data		= compact('email','message','date','inbox');
$db->insert("contact",$data);

mail_send($email, $subject, $pesan);
posted('contact');
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
    <td valign="top"><img src="<?php if(function_exists('load_captcha')){ _e(load_captcha());}?>"  style="border:1px solid #999;margin-top:2px;"></td>
  </tr>
  <tr>
    <td valign="top"></td>
    <td valign="top"></td>
    <td valign="top"><input class='input' name='gfx_check' type='text' size=10/></td>
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
					</div>
				</div>
			</article>
		</div>
	</div>
</div>
