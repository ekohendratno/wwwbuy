<?php
/**
 * @file ilogin.php
 *
 */
//dilarang mengakses
defined('_iEXEC') or die();

$go 	= filter_txt($_GET['go']);
$act 	= filter_txt($_GET['act']);
$keys 	= filter_txt($_GET['keys']);
$to 	= filter_txt($_GET['to']);
global $iw,$db,$access,$session;
$obj 	= country();
$sess   = $session->get('user_name');
if(!function_exists('change_password')){
	function change_password($data){
		global $iw,$db,$access;		
		extract($data, EXTR_SKIP);
		
		$user_login	= esc_sql($username);
		$newpass	= esc_sql($newpass);
		$old_pass	= esc_sql($oldpass);
		$repass		= esc_sql($repass);
		
		$oldpass	= md5($oldpass);
		$user_pass	= md5($newpass);
		
		if(empty($newpass) || empty($repass)) $msg[] = '<strong>ERROR</strong>: New & Re Password is empty</a>';
		
		if($newpass !== $repass) $msg[] = '<strong>ERROR</strong>: Invalid New Password & Re Password not match</a>';
		
		$field = $access->username_cek( compact('user_login') );
		if($field['row']['user_pass'] !== $oldpass) $msg[] = '<strong>ERROR</strong>: Invalid Old Password not match</a>';
		
		if( is_array($msg))	{
			foreach($msg as $val){
				_e('<div id="error">'.$val.' </div>');
			}
		}
		if(empty($msg)){
			$update = $access->change_password(compact('user_pass'),compact('user_login'));
			if($update) _e('<div id="success">The Password success to change</div>');
		}
	}
}

switch($go){
case'profile':
?>
<div id="frame_login">
<div class="box-head dotted">Profile Manager</div>
<div id="box-content">
<?php
if(!$access->cek_login()){
	redirect('?login');
}else{
?>
<link href="iadmin/templates/css/profile-style.css" rel="stylesheet" media="screen" type="text/css" />
<ul id="tabs" class="tabs">
<?php
if($to=='password'){
_e('<li><a href="?login&go=profile">Home</a></li>
	<li><a href="?login&go=profile&to=password" class="selected">Password</a></li>
	<li><a href="?login&go=profile&to=avatar">Avatar</a></li>');
}elseif($to=='avatar'){
_e('<li><a href="?login&go=profile">Home</a></li>
	<li><a href="?login&go=profile&to=password">Password</a></li>
	<li><a href="?login&go=profile&to=avatar" class="selected">Avatar</a></li>');
}else{	
_e('<li><a href="?login&go=profile" class="selected">Home</a></li>
	<li><a href="?login&go=profile&to=password">Password</a></li>
	<li><a href="?login&go=profile&to=avatar">Avatar</a></li>');
}
?>
</ul>
<?php 
if($to=='password'){
if (isset($_POST['submit'])){
	$username	= filter_txt($_POST['username']);
	$oldpass	= filter_txt($_POST['oldpass']);
	$newpass	= filter_txt($_POST['newpass']);
	$repass		= filter_txt($_POST['repass']);
	
	$data = compact('username','oldpass','newpass','repass');
	change_password($data);
}
$q	= $db->query("SELECT * FROM `".$iw->pre."users` WHERE `user_login` = '$sess'");
$r  = $db->fetch_array($q);
?>
<form name="form1" method="post" action="">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="27%" align="right"> Old Password </td>
      <td width="1%"><strong>:</strong></td>
      <td width="72%" align="left">
      <input type="hidden" name="username" value="<?php _e($r['user_login'])?>">
      <input type="password" name="oldpass" value="" style="width:150px;"></td>
    </tr>
    <tr>
      <td width="27%" align="right"> New Password </td>
      <td width="1%"><strong>:</strong></td>
      <td width="72%" align="left">
      <input type="password" name="newpass" value="" style="width:150px;"></td>
    </tr>
    <tr>
      <td width="27%" align="right"> Re Password </td>
      <td width="1%"><strong>:</strong></td>
      <td width="72%" align="left">
      <input type="password" name="repass" value="" style="width:150px;"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td align="left"><button name="submit" class="primary"><span class="icon pen"></span>Save & Update</button> or <button name="Reset"><span class="icon loop"></span>Reset</button></td>
    </tr>
  </table>
</form>
<?php 
}elseif($to=='avatar'){
$q	= $db->query("SELECT * FROM `".$iw->pre."users` WHERE `user_login` = '$sess'");
$r  = $db->fetch_array($q);
?>
<br>
<p>
<img src="<?php _e(get_gravatar($r['user_email']));?>" alt="" style="width:50px;border:1px solid #ddd;"><br />
Silahkan edit profile gravatar anda <a href="http://gravatar.com/" target="_blank">disini</a>
</p>
<?php
}else{ 
if (isset($_POST['submit'])){
	$user_id	= filter_txt($_POST['user_id']);
	$username	= filter_txt($_POST['username']);
	$author		= filter_txt($_POST['author']);
	$email		= filter_txt($_POST['email']);
	$sex		= filter_int($_POST['sex']);
	$country	= filter_txt($_POST['country']);
	$province	= filter_txt($_POST['province']);
	
	if( empty($sex) ) $msg[] = '<strong>ERROR</strong>: The sex field not select.'; 
	
	if( is_array($msg))	{
	foreach($msg as $val){
		_e('<div id="error">'.$val.' </div>');
	}}
	if(empty($msg)){
	$userdata	= compact('username','email','sex','author','user_id');
	$more		= compact('country','province')+array('status'=>2);
	$access->update_user($userdata,$more);
	}
}
$q	= $db->select( 'users', array('user_login' => $sess) );
$r  = $db->fetch_array($q);
?>
<form name="form1" method="post" action="">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="27%" align="right"> User Name </td>
      <td width="1%"><strong>:</strong></td>
      <td width="72%" align="left">
      <input type="text" name="username" value="<?php _e($r['user_login'])?>" disabled="disabled" style="width:150px;">
      <input type="hidden" name="username" value="<?php _e($r['user_login'])?>"><input type="hidden" name="user_id" value="<?php _e($r['ID'])?>"></td>
    </tr>
    <tr>
      <td width="27%" align="right"> E-Mail </td>
      <td width="1%"><strong>:</strong></td>
      <td width="72%" align="left">
      <input type="text" name="email" value="<?php _e($r['user_email'])?>" style="width:150px;"></td>
    </tr>
    <tr>
      <td width="27%" align="right">Author Name </td>
      <td width="1%"><strong>:</strong></td>
      <td width="72%" align="left">
      <input type="text" name="author" value="<?php _e($r['user_author'])?>" style="width:150px;"></td>
    </tr>
    <tr>
      <td align="right">Seorang </td>
      <td><strong>:</strong></td>
      <td align="left"><select name="sex">
      <?php
	  $sex = (int)$r['user_sex'];
	  if($sex==0):
	  ?>
        <option value="0">Pilih Jenis kelamin</option>
        <option value="1" selected="selected">Perempuan</option>
        <option value="2">Laki laki</option>
      <?php
	  elseif($sex==1):
	  ?>
        <option value="0">Pilih Jenis kelamin</option>
        <option value="1">Perempuan</option>
        <option value="2" selected="selected">Laki laki</option>
      <?php
	  else:
	  ?>
        <option value="0" selected="selected">Pilih Jenis kelamin</option>
        <option value="1">Perempuan</option>
        <option value="2">Laki laki</option>
      <?php
	  endif;
	  ?>
      </select></td>
    </tr>
    <tr>
      <td align="right">Country </td>
      <td><strong>:</strong></td>
      <td align="left"><select name="country">
      <?php
	  $obj->CountryList($r['user_country']);
	  ?>
      </select></td>
    </tr>
    <tr>
      <td width="27%" align="right"> Province </td>
      <td width="1%"><strong>:</strong></td>
      <td width="72%" align="left">
      <input type="text" name="province" value="<?php _e($r['user_province'])?>" style="width:300px;"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td align="left"><button name="submit" class="primary"><span class="icon pen"></span>Save & Update</button> or <button name="Reset"><span class="icon loop"></span>Reset</button></td>
    </tr>
  </table>
</form>
<?php 
}
}
?>
</div>
<?php
break;
case'register':
if(!get_option('account')):
?>	
<div id="frame_login">
<div class="box-head dotted">Registration not found</div>
<div id="box-content" align="center">
<p class="message">Maaf tidak dapat mendaftar, form registration telah di non aktifkan</p>
</div>
<?php
else:
if($act=='term'){
?>
<div id="frame_login">
<div class="box-head dotted">Term of use</div>
<div id="box-content" align="center">
<textarea name="term" style="width:95%;max-width:95%; height:200px">
Common rules of a portal
1. Our portal is opened for visiting by all interested person. To use all size of services of a site, it is necessary for you to register.
2. The user of a portal can become any person, agreed to observe the given rules.
3. Each participant of dialogue has the right to confidentiality of the information on. Therefore do not discuss financial, family and other interests of participants without the permission on it the participant.
4. Call on a site occurs on "you". It is not the disrespectful or unfriendly sign in relation to the interlocutor.
5. Our portal - postmoderated. The information placed on a site, preliminary is not viewed and not edited, but administration and moderators reserve the right to itself to make it later.
6. All messages mirror only opinions of their authors.
7. The order on a portal is watched by moderators. They have the right to edit, delete messages and to close subjects in sections inspected by them.
8. Before creation of a new subject at a forum, it is recommended to take advantage of search. Probably question which you wish to set, was already discussed. If you have troubleshot by own strength, please, write about it, with the instruction of how you have made it. If wish to close the subject or the message, inform on it to the moderator.
9. Create new subjects only in appropriate sections. If the subject does not approach under one of sections or you doubt of correctness of the choice - create it in section of a forum "Bulletin board".
10. Before sending messages or to use services of a portal, you are obliged to familiarize with the common rules, and also rules of that department closely.
11. In case of rough violations of rules, the manager reserves the right to itself to eliminate the user from a site without warnings. Repeated registration of the user in cases of deleting is eliminated.
12. The manager reserves the right to itself to change the given rules without the prior notification. All changes inure from the moment of their publication.
13. The information and links are presented exclusively in the educational purposes and intended only for satisfaction of curiosity of visitors.
14. You undertake to not apply the received information with a view of, prohibited FC the Russian Federation and norms of international law.
15. Authors of the given site do not carry the responsibility for possible consequences of usage of the information and links.
16. If you do not agree with the above-stated requirements, in that case you should leave our site immediately.\n
On a site it is forbidden\n
1. To break subjects of forums and sections.
2. To create subjects which recently were already discussed in the same forum.
3. To create the same subject in several sections.
4. To create subjects with empty names.
5. To use not normative lexicon, rough expressions in relation to the interlocutor, to offend national or religious feelings of interlocutors, and also to write messages capital letters.
6. To place advertising. Advertising the link to a promoted site, with the address or without also is considered, or a homepage in the signature.
7. To expose cracks, serial numbers to programs or already cracked programs. Also it is forbidden to leave links to them.
8. To write messages, which do not carry the helpful information (flood, offtop) in subject sections.
9. To discuss and condemn operations of moderators and administrations, it is possible only in personal correspondence or in the complaint, the routed administration of a portal. 
</textarea>
<div style="margin-top:2px;">
<button class="button" onclick="javascript:history.back(-1)"><span class="icon leftarrow"></span>Back</button>
</div>
</div>
<?php
}else{
global $iw,$access;
if (isset ($_POST['submit_reg'])){
	$username 	= filter_txt($_POST['username']);
	$author 	= filter_txt($username);
	$email		= filter_txt($_POST['email']);
	$sex		= filter_int($_POST['sex']);
	$securecode	= filter_txt($_POST['securecode']);
	$check		= filter_int($_POST['chekterm']);
	$country	= filter_txt($_POST['country']);
	
	
	if( empty( $country ) )
		$msg[] = '<strong>ERROR</strong>: The country field not select.';
	if( empty( $securecode ) )
		$msg[] = '<strong>ERROR</strong>: The anti spam field is empty.';
	else
	if( $securecode != $_SESSION['Var_session'] )
		$msg[] = '<strong>ERROR</strong>: The anti spam not valid.';
	if( empty( $check ) || $check != 1)
		$msg[] = '<strong>ERROR</strong>: The term of use field not cheked.';
	
	if(is_array($msg)){
	foreach($msg as $val){
		_e('<div id="error">'.$val.' </div>');
	}}
		
	$userdata	= compact('username','author','email','sex');
	$access->create_user($userdata,compact('country'));
}
?>
<div id="frame_login">
<div class="box-head dotted">Register</div>
<div id="box-content">
<form name="form1" method="post" action="">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="27%" align="right"> User Name <span class="req">*</span> </td>
      <td width="1%"><strong>:</strong></td>
      <td width="72%" align="left">
      <input type="text" name="username" value=""></td>
    </tr>
    <tr>
      <td width="27%" align="right"> E-Mail <span class="req">*</span> </td>
      <td width="1%"><strong>:</strong></td>
      <td width="72%" align="left">
      <input type="text" name="email" value=""></td>
    </tr>
    <tr>
      <td align="right">Saya seorang <span class="req">*</span> </td>
      <td><strong>:</strong></td>
      <td align="left"><select name="sex">
        <option value="0" selected="selected">Pilih Jenis kelamin</option>
        <option value="1">Perempuan</option>
        <option value="2">Laki laki</option>
      </select></td>
    </tr>
    <tr>
      <td align="right">Country <span class="req">*</span> </td>
      <td><strong>:</strong></td>
      <td align="left"><select name="country">
      <?php
	  $obj->CountryList($r['user_country']);
	  ?>
      </select></td>
    </tr>
    <tr>
      <td align="right">Anti Spam <span class="req">*</span> </td>
      <td><strong>:</strong></td>
      <td align="left"><img src='<?php if(function_exists('load_captcha')){ _e(load_captcha());}?>'  style="border:1px solid #999"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td align="left">
      <input type="text" name="securecode" style="width:50px" value=""></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td align="left">
      <input name="chekterm" value="1" id="term" type="checkbox" style="width:14px"><label for="term">Do you agree to the site <a href="?login&amp;go=register&amp;act=term">Terms and Conditions?</a></label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td align="left"><button class="button" name="submit_reg"><span class="icon user"></span>Register Now</button>
<span class="req">* required</span></td>
    </tr>
  </table>
</form>
</div>
<?php
}
endif;
break;
case'lostpass':
global $access;
if (isset ($_POST['submit_send'])){
	$user_email = filter_txt($_POST['email']);
	$securecode	= filter_txt($_POST['securecode']);
	
	$access->lost_password($user_email,$securecode);
}
?>
<div id="frame_login">
<div class="box-head dotted">Lost Password</div>
<div id="box-content">
<form method="post" action="">
	  <table width="100%" border="0" cellspacing="0" cellpadding="2">
		<tbody>
		  <tr>
		  <td width="30%" align="right" valign="middle">E-Mail <span class="req">*</span></td>
		  <td width="1%" align="left" valign="middle"><strong>:</strong></td>
		  <td width="69%" align="left" valign="top">
		  <input type="text" name="email"></td>
		</tr>
		<tr>
		  <td align="right" valign="middle">Anti Spam <span class="req">*</span></td>
		  <td align="left" valign="middle"><strong>:</strong></td>
		  <td align="left" valign="top"><img src='<?php if(function_exists('load_captcha')){ _e(load_captcha());}?>'  style="border:1px solid #999"></td>
		</tr>
		<tr>
		  <td align="left" valign="top">&nbsp;</td>
		  <td align="left" valign="top">&nbsp;</td>
		  <td align="left" valign="top">
		  <input type="text" name="securecode" style="width:50px"></td>
		</tr>
		<tr>
		  <td align="left" valign="top">&nbsp;</td>
		  <td align="left" valign="top">&nbsp;</td>
		  <td align="left" valign="top"><button class="button" name="submit_send"><span class="icon mail"></span>Send New Password</button><span class="req">* required</span></td>
		</tr>
	  </tbody></table>
	</form>
</div>
<?php
break;
case'activation':
global $iw,$access;
if(isset($keys) && !empty($keys)){
if(isset ($_POST['submit_activ'])){
	$codeaktivasi = filter_txt($_POST['codeaktivasi']);
	$access->activation($codeaktivasi);
}
?>
<div id="frame_login">
<div class="box-head dotted">Account Activation</div>
<div id="box-content">
<form method="post" action="">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="left" valign="top">Code Aktivasi</td>
    </tr>
    <tr>
      <td align="left" valign="top"><input type="text" name="codeaktivasi" value="<?php _e($keys);?>" style="width:95%"></td>
    </tr>
    <tr>
      <td align="left" valign="top"><button class="button" name="submit_activ">Activation Now</button></td>
    </tr>
  </table>
</form><br />
</div>
<?php
}else{
	redirect();
}
break;
case'logout':
global $access;
$access->login_out();
break;
default:
global $iw,$access;
if(!$access->cek_login()){
if (isset ($_POST['submit_login']) && @$_POST['loguser'] == 1){
	$user_login = filter_txt($_POST['user_login']);
	$user_pass  = filter_txt($_POST['user_pass']);
	
	$access->set_login($user_login,$user_pass);
	
}
?>
<div id="frame_login">
<div class="box-head dotted">Login</div>
<div id="box-content">
<form action="" method="post" id="login" style="left: 0px; position: static; ">
<label for="user_login" class="label_username">User</label>
<input type="text" name="user_login" title="Enter your username" />
<label for="user_pass" class="label_password">Password</label>
<input type="password" name="user_pass" title="Enter your password" />
<button class="button" name="submit_login"><span class="icon unlock"></span>Unlock</button><input type="hidden" name="loguser" value="1" />
</form>
</div>
<?php
}else{	
	redirect();
}
break;
}
?>
</div></div>
<div id="breadcrumb">
<?php
if($go!=='lostpass'){
?>
<ul class="left">
	<li class="icon key"><a href="?login&amp;go=lostpass">Lupa Kata Sandi ?</a></li>
</ul>
<?php
}
?>
<ul class="right">
	<li><a href="?login&amp;go=faq" class="icon support tip" title="FAQ">FAQ</a></li>
	<li><a href="?login" class="icon home tip" title="Home">Home</a></li>
</ul>
</div>