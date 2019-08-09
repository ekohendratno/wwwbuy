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

<div class="box-head dotted">Backup Manager</div>
<div id="box-content">
<?php
global $iw,$db,$session;
$go 	= filter_txt($_GET['go']);
$act	= filter_txt($_GET['act']);
$name	= filter_txt($_GET['name']);

$widget = array(
'menu'		=> menu(),
'gadget'	=> array( gadget() ),
'help_desk' => 'dengan tool ini anda melakukan backup database maupun file website anda secara mudah dan instant'
);

switch($go){
default:

file_timeout();

if($act == 'download' && !empty($act)){
	if(!empty($name)){
		$file = decode($name).'.zip';
		backup_download('./tmp/',$file); 
	}
}
if(isset($_POST['submit'])){
	$dir_backup 	= array($_POST['dir_backup']	);
	$dir_skip 		= array($_POST['dir_skip']		);
	$encrypt 		= filter_txt($_POST['encrypt']	);
	$inc_db 		= filter_txt($_POST['inc_db']	);
	$dir_store 		= filter_txt($_POST['dir_store']);
	$name		 	= filter_txt($_POST['name']		);
	$timeout	 	= filter_int($_POST['timeout']	);
	
	$data = compact('dir_backup','dir_skip','encrypt','inc_db','dir_store','name','timeout');
	save_file($data);
	
?>	
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="15%"> Path Backup </td>
    <td width="1%"><strong>:</strong></td>
    <td width="85%">
	<?php 
	foreach($dir_backup as $key){
	_e($key);
	}
	?>
    </td>
  </tr>
  <tr>
    <td> Path Skip </td>
    <td><strong>:</strong></td>
    <td>
	<?php 
	foreach($dir_skip as $key){
	_e($key);
	}
	?>
    </td>
  </tr>
  <tr>
    <td> Path Store </td>
    <td><strong>:</strong></td>
    <td><?php _e($dir_store)?></td>
  </tr>
  <tr>
    <td> Name File </td>
    <td><strong>:</strong></td>
    <td><?php _e($name)?></td>
  </tr>
  <tr>
    <td>Name Encrypt</td>
    <td><strong>:</strong></td>
    <td><?php if( !empty( $encrypt ) || $encrypt == 1) _e( md5($name) );?></td>
  </tr>
  <tr>
    <td>Name Encode</td>
    <td><strong>:</strong></td>
    <td><?php _e( encode($name) )?></td>
  </tr>
  <tr>
    <td> Time Out </td>
    <td><strong>:</strong></td>
    <td><?php _e($timeout)?> second</td>
  </tr>
  <tr>
    <td>Date</td>
    <td><strong>:</strong></td>
    <td><?php _e( datetimes(date('Y-m-d H:i:s')) )?></td>
  </tr>
  <tr>
    <td>File Type</td>
    <td><strong>:</strong></td>
    <td>.zip</td>
  </tr>
  <tr>
    <td>File Size</td>
    <td><strong>:</strong></td>
    <td><?php 
	if(!empty( $encrypt ) || $encrypt == 1) $backup_name = md5($name);
		else $backup_name = $name;
		
	$backup_name	= $backup_name.'.zip';	
	foreach($dir_skip as $key){
	_e( file_size(filesize($key.$backup_name)) );
	}
	?>
    </td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <?php
	if( !empty( $encrypt ) || $encrypt == 1) $file = md5($name);
	else $file = $name;
	?>
    <td><a target="_blank" class="button" href="?admin&sys=backup&act=download&name=<?php _e( encode($file) )?>">Download Now</a></td>
  </tr>
</table>	
<?php	
}else{
?>
<form action="" method="post" enctype="multipart/form-data" name="form1">
  <table width="100%">
    <tbody>
    <tr>
      <td valign="top" width="24%">Path Backup</td>
      <td valign="top" width="1%"><strong>:</strong></td>
      <td width="75%"><textarea type="text" name="dir_backup" style="width:300px; height:60px;"><?php _e(abs_path)?></textarea></td>
    </tr>
    <tr>
      <td valign="top" width="24%">Path Skip</td>
      <td valign="top" width="1%"><strong>:</strong></td>
      <td width="75%"><textarea type="text" name="dir_skip" style="width:300px; height:60px;"><?php _e(Tmp)?></textarea></td>
    </tr>
    <tr>
      <td valign="top" width="24%">Path Store</td>
      <td valign="top" width="1%"><strong>:</strong></td>
      <td width="75%"><textarea type="text" name="dir_store" style="width:300px; height:60px;"><?php _e(Tmp)?></textarea>
      </td>
    </tr>
    <tr>
      <td valign="top" width="24%">Name File</td>
      <td valign="top" width="1%"><strong>:</strong></td>
      <td width="75%"><input type="text" name="name" value="<?php _e('backup-'.date('d-m-y_H-i-s'))?>" style="width:200px;"></td>
    </tr>
    <tr>
      <td valign="top" width="24%"></td>
      <td valign="top" width="1%"></td>
      <td width="75%">
      	<input type="checkbox" name="encrypt" id="encrypt" />
        <label for="encrypt">Encrypt Name File</label><br />
        <input type="checkbox" name="inc_db" id="inc_db" />
        <label for="inc_db">Include Database</label>
      </td>
    </tr>
    <tr>
      <td valign="top" width="24%">Time Out</td>
      <td valign="top" width="1%"><strong>:</strong></td>
      <td width="75%"><input type="text" name="timeout" value="600" style="width:30px;"> * second</td>
    </tr>
  </tbody></table>
<div class="num" style="text-align: left;">
<button name="submit" class="primary"><span class="icon clock"></span>Create Backup Now</button> or <button name="Reset"><span class="icon loop"></span>Reset</button>
</div></form>
<?php
}
break;
}
?>
</div>


