<?php

	if(!defined('MEMBER')) exit;

	if (!cek_login ()) exit;

	$tengah  = '';
	
	
	
	if($_GET['aksi'] =='' || $_GET['aksi'] =='rj'){
		
		if( $_GET['go'] == 'add' ){
			
		$tengah .= '
		<div class="box">
		<h2 class="widget-title">Tambah <span class="styled1">Jaringan</span></h2>
		<div class="breadcrumb"><a href="member.php?mod=diagram" id="home">Tambah Jaringan</a>   &nbsp;&raquo;&nbsp;   Biodata Calon Anggota</div>
		</div>
					<div class="border rb">
<form><table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td width="28%" align="left" valign="top">Nama Lengkap*</td>
    <td width="1%" align="left" valign="top"><strong>:</strong></td>
    <td width="28%" align="left" valign="top"><input name="textfield" type="text" size="50"></td>
    <td width="43%" align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">Chek ID*</td>
    <td align="left" valign="top"><strong>:</strong></td>
    <td align="left" valign="top"><input type="text" name="textfield2"></td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">Kode Sponsor*</td>
    <td align="left" valign="top"><strong>:</strong></td>
    <td align="left" valign="top"><input name="textfield3" type="text" size="15"></td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">Nomor KTP*</td>
    <td align="left" valign="top"><strong>:</strong></td>
    <td align="left" valign="top"><input name="textfield4" type="text" size="50"></td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">Nomor HP*</td>
    <td align="left" valign="top"><strong>:</strong></td>
    <td align="left" valign="top"><input type="text" name="textfield5"></td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">User Name*</td>
    <td align="left" valign="top"><strong>:</strong></td>
    <td align="left" valign="top"><input type="text" name="textfield6"></td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">Password*</td>
    <td align="left" valign="top"><strong>:</strong></td>
    <td align="left" valign="top"><input type="text" name="textfield7"></td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">Konfirmasi Password*</td>
    <td align="left" valign="top"><strong>:</strong></td>
    <td align="left" valign="top"><input type="text" name="textfield8"></td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">Jenis Kelamin*</td>
    <td align="left" valign="top"><strong>:</strong></td>
    <td align="left" valign="top"><select name="select" id="select">
      <option value="l">Laki-Laki</option>
      <option value="p">Perempuan</option>
    </select></td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">Alamat Lengkap</td>
    <td align="left" valign="top"><strong>:</strong></td>
    <td align="left" valign="top"><textarea name="textarea" id="textarea" cols="45" rows="5"></textarea></td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">Kabupaten/Kota</td>
    <td align="left" valign="top"><strong>:</strong></td>
    <td align="left" valign="top"><select name="select2" id="select2">
    </select></td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">Telephone*</td>
    <td align="left" valign="top"><strong>:</strong></td>
    <td align="left" valign="top"><input name="textfield12" type="text" size="50"></td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">Tempat &amp; Tanggal Lahir*</td>
    <td align="left" valign="top"><strong>:</strong></td>
    <td align="left" valign="top"><input name="textfield13" type="text" size="50"></td>
    <td align="left" valign="top">&amp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top"><select name="select3" id="select3">
    </select>
      <select name="select4" id="select4">
      </select>
      <select name="select5" id="select5">
      </select></td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">Ahli Waris</td>
    <td align="left" valign="top"><strong>:</strong></td>
    <td align="left" valign="top"><input name="textfield14" type="text" size="50"></td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">Nomor Rekening</td>
    <td align="left" valign="top"><strong>:</strong></td>
    <td align="left" valign="top"><input name="textfield15" type="text" size="50"></td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">Nama Bank</td>
    <td align="left" valign="top"><strong>:</strong></td>
    <td align="left" valign="top"><input name="textfield16" type="text" size="50"></td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">Atas Nama</td>
    <td align="left" valign="top"><strong>:</strong></td>
    <td align="left" valign="top"><input name="textfield17" type="text" size="50"></td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">Email</td>
    <td align="left" valign="top"><strong>:</strong></td>
    <td align="left" valign="top"><input name="textfield18" type="text" size="50"></td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top"><input type="button" name="button" id="button" value="Kirim Data"></td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4"><p>)* Wajib diisi</p>
      <p>Registrasi tidak bisa dilakukan antara Jam 11.00 s/d Jam 13.00<br>
        Virtual Office | Kendaraan Bisnis - Copyright 2013 kendaraanbisnis.com. All rights reserved.<br>
        NOTICE: We collect personal information on this site.<br>
      2014-01-24 11:54:51</p></td>
    </tr>
</table>
</form></div>';
		}else{
			$tengah .= '
		<div class="box">
		<h2 class="widget-title">Diagram <span class="styled1">Jaringan</span></h2>
		<div class="breadcrumb"><a href="member.php?mod=diagram" id="home">Ringkasan Jaringan</a>   &nbsp;&raquo;&nbsp;   Diagram Jaringan Manager</div>
		</div>
					
					<table width="100%" border="0" cellspacing="2" cellpadding="2" class="list">
  <tr>
    <td colspan="4" align="center"><p>Login ID : 12345<br>Name : RIZKI HALAL<br>Posisi : A</p></td>
  </tr>
  <tr>
    <td colspan="2" align="center" style="width:50%;"><p>12345<br>SETAN<br>Posisi : A<br>Downline : 0</p></td>
    <td colspan="2" align="center" style="width:50%;"><p>12345<br>SETAN<br>Posisi : A<br>Downline : 0</p></td>
  </tr>
  <tr>
    <td align="center"><a href="member.php?mod=diagram&aksi=rj&go=add&p=l&i=1234">Add downline</a></td>
    <td align="center"><a href="member.php?mod=diagram&aksi=rj&go=add&p=r&i=1234">Add downline</a></td>
    <td align="center"><a href="#">Add downline</a></td>
    <td align="center"><a href="#">Add downline</a></td>
  </tr>
</table>';
		}
	}elseif($_GET['aksi'] =='jb'){

		$tengah .= '
		<div class="box">
		<h2 class="widget-title">Diagram <span class="styled1">Jaringan</span></h2>
		<div class="breadcrumb"><a href="member.php?mod=diagram" id="home">Ringkasan Jaringan</a>   &nbsp;&raquo;&nbsp;   Diagram Jaringan Manager</div>
		</div>
					<div class="border rb">
					<form action="" method="post">
						<table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td width="23%">View By</td>
    <td width="1%"><strong>:</strong></td>
    <td width="76%">
    <select name="by">
							<option value="i">ID</option>
							<option value="n">NAME</option>
						</select>
    </td>
  </tr>
  <tr>
    <td>ID</td>
    <td><strong>:</strong></td>
    <td>
    <select name="i">
							<option value="1234">1234</option>
							<option value="1235">1235</option>
							<option value="1236">1236</option>
						</select>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="submit" name="proses" id="proses" value="Kirim"></td>
  </tr>
</table>

					</form>
					</div>';
	}elseif($_GET['aksi'] =='jpb'){

		$tengah .= '
		<div class="box">
		<h2 class="widget-title">Diagram <span class="styled1">Jaringan</span></h2>
		<div class="breadcrumb"><a href="member.php?mod=diagram" id="home">Ringkasan Jaringan</a>   &nbsp;&raquo;&nbsp;   Diagram Jaringan Manager</div>
		</div>
					<table class="list">
					<thead>
						<tr class="head">
							<td style="text-align: left;">Member ID</td>
							<td style="text-align: left;">Downline ID</td>
							<td style="text-align: center;">Ringkasan Jaringan</td>
						</tr>
					</thead>
					<tbody>';											
						$tengah .= '<tr'.$warna.'>
						<td class="left">12345</td>
						<td class="left">123456</td>
						<td style="text-align: center;"><a href="member.php?mod=diagram&aksi=rj&go=add&p=l&i=1234">Lihat Jaringan</a></td>
						</tr>';									
						$tengah .= '<tr'.$warna.'>
						<td class="left">12345</td>
						<td class="left">123457</td>
						<td style="text-align: center;"><a href="member.php?mod=diagram&aksi=rj&go=add&p=l&i=1234">Lihat Jaringan</a></td>
						</tr>';
					$tengah .= '
					</tbody>
					</table>';
				

	}
	
echo $tengah;
?>