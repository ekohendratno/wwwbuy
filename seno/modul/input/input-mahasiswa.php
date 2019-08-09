<div class="content_header">Mahasiswa</div>
<?php
$add_query = "WHERE npm='".$_GET['npm']."'";
if( isset($_POST['lihat']) ){
	$npm = $_POST['npm'];
	$add_query ="WHERE npm='".$npm."'";
	$_GET['npm'] = $npm;
	
	$thumb = $_FILES['file'];
	
	$myfile 	 = $thumb; //image name
	$uploadDir 	 = '../modul/upload/'; //directory upload file
	$data_upload = compact('myfile','uploadDir');
	uploader($data_upload);
}

$query_npm = mysql_query("SELECT * FROM mahasiswa $add_query");
$row_npm = mysql_fetch_object($query_npm);
?>
<form action="" method="post" enctype="multipart/form-data">
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr>
      <td width="13%" rowspan="8" valign="top">
      <img src="modul/upload/<?php echo $row_npm->gambar?>" style="width:120px;" />
      </td>
      <td width="13%">NPM</td>
      <td width="87%"><?php echo js_redirect()?>
        <select name="npm_op" onchange="redir(this)"><option value="">-- Pilih --</option><?php list_npm_op('?sis=input&v=mahasiswa')?></select>
        <input type="text" name="npm"  style="width:250px; text-align:left" value="<?php echo $row_npm->npm?>"/>
        <input type="submit" name="lihat" id="button" value="Lihat" /></td>
    </tr>
    <tr>
      <td>Nama</td>
      <td>
        <input type="text" name="nama" value="<?php echo $row_npm->nama?>" style="width:250px; text-align:left" /></td>
    </tr>
    <tr>
      <td>Jurusan</td>
      <td>
        <input type="text" name="jurusan" value="<?php echo $row_npm->jurusan?>" style="width:250px; text-align:left" /></td>
    </tr>
    <tr>
      <td>IPK</td>
      <td>
        <input type="text" name="ipk" value="<?php echo $row_npm->ipk?>" style="width:250px; text-align:left" /></td>
    </tr>
    <tr>
      <td>Email</td>
      <td>
        <input type="text" name="email" value="<?php echo $row_npm->email?>" style="width:250px; text-align:left" /></td>
    </tr>
    <tr>
      <td>No Telp</td>
      <td>
        <input type="text" name="no_telp" value="<?php echo $row_npm->no_telp?>" style="width:250px; text-align:left" /></td>
    </tr>
    <tr>
      <td>Gambar</td>
      <td>
      <input type="file" name="file" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="submit" id="submit" value="Ubah" />
      <input type="reset" name="reset" id="reset" value="Reset" /></td>
    </tr>
  </table>
</form>
