<div class="content_header">Input Alternatif</div>
<?php
$user_id = get_uname_id();
$query_npm = mysql_query("SELECT * FROM mahasiswa WHERE npm='".$_GET['npm']."'");
$row_npm = mysql_fetch_object($query_npm);

if( isset($_POST['submit']) ){
		$npm = $_POST['npm'];
		$nama = $_POST['nama'];
		
		$query_npm_jumlah = mysql_query("SELECT * FROM kandidat WHERE user_id='$user_id'");
		$num_npm = mysql_num_rows($query_npm_jumlah);
		
		if( empty($npm) ) echo '<div class="error">Maaf NPM belum dipilih</div><br>';
		elseif($num_npm>=3) echo '<div class="error">Maaf jumlah kandidat sudah melebihi batas</div><br>';
		else{
		
		$query_npm_run = mysql_query("INSERT INTO kandidat (`npm`,`user_id`,`nama`) VALUES ('$npm','$user_id','$nama')");
		if( $query_npm_run ) echo '<div class="sukses">Kandidat berhasil ditambahkan</div><br>';
		
		}
}
?>
<form action="" method="post">
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr>
      <td width="13%">NPM</td>
      <td width="87%"><?php echo js_redirect()?>
        <select name="npm_op" onchange="redir(this)"><option value="">-- Pilih --</option><?php list_npm_op()?></select>
        <input type="hidden" name="npm" value="<?php echo $row_npm->npm?>" />
        </td>
    </tr>
    <tr>
      <td>Nama</td>
      <td><input type="hidden" name="nama" value="<?php echo $row_npm->nama?>" /><?php echo $row_npm->nama?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="submit" value="Submit" />
        <input type="reset" name="reset" value="Reset" /></td>
    </tr>
  </table>
</form>
<br />
<?php
if( $_GET['act'] == 'del' ){
	$npm = $_GET['npm'];
	$del_query = mysql_query("DELETE FROM kandidat WHERE user_id='$user_id' AND npm='$npm'");
	if( $del_query ) echo '<div class="sukses">Kandidat berhasil dihapus</div><br>';
	else echo '<div class="error">Kandidat gagal dihapus</div><br>';
}
?>
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr>
      <td width="8%" align="center">No</td>
      <td width="43%" align="center">NPM</td>
      <td width="49%" align="center">Nama</td>
      <td width="49%" align="center">Aksi</td>
    </tr>
<?php
$i=1;
$query_npm = mysql_query("SELECT * FROM kandidat WHERE user_id='$user_id'");
$num_npm = mysql_num_rows($query_npm);

if( $num_npm < 1 ){
?>
	<tr>
      <td colspan="4" align="left">Kandidat kosong</td>
    </tr>
<?php
}

while($row_npm = mysql_fetch_object($query_npm)){
?>
    <tr>
      <td align="center"><?php echo $i?></td>
      <td align="center"><?php echo $row_npm->npm?></td>
      <td align="center"><?php echo $row_npm->nama?></td>
      <td align="center"><a href="?sis=input&v=alternatif&act=del&npm=<?php echo $row_npm->npm?>">Hapus</a></td>
    </tr>
<?php $i++;}?>
  </table>