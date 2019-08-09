<?php

	if(!defined('MEMBER')) exit;

	if (!cek_login ()) exit;

	$tengah  = '';
	if (isset ($_GET['pg'])) $pg = int_filter ($_GET['pg']); else $pg = 0;
	if (isset ($_GET['stg'])) $stg = int_filter ($_GET['stg']); else $stg = 0;
	if (isset ($_GET['offset'])) $offset = int_filter ($_GET['offset']); else $offset = 0;
	
	
	
	if($_GET['aksi'] =='' || $_GET['aksi'] =='rj'){

		$tengah .= '
		<div class="box">
		<h2 class="widget-title">Diagram <span class="styled1">Jaringan</span></h2>
		<div class="breadcrumb"><a href="member.php?mod=diagram" id="home">Ringkasan Jaringan</a>   &nbsp;&raquo;&nbsp;   Diagram Jaringan Manager</div>
		</div>
					<div class="border rb">
					<table class="list">
					<thead>
						<tr class="head">
							<td style="text-align: center;">No.</td>
							<td style="text-align: left;">Name</td>
							<td style="text-align: center;">Email</td>
							<td style="text-align: center;">Level</td>
							<td style="text-align: center;">Status</td>
							<td style="text-align: center;">Action</td>
						</tr>
					</thead>
					<tbody>';
					
					if (isset($_POST['search'])){
						$search = cleantext($_POST['search']);
						$QUERY =  "WHERE `username` LIKE '%$search%' OR `name` LIKE '%$search%' OR `email` LIKE '%$search%'";
					}else{
						$QUERY = "";
					}
					
					$jqa 	= $db->sql_query("SELECT * FROM `mod_user` $QUERY ORDER BY `name` ASC");
					$jumlah = $db->sql_numrows($jqa);
					$limit 	= 30;							
					$a 		= new paging ($limit);

					if(isset($offset)){
						$no = $offset + 1;
					}else{
						$no = 1;
					}
				
					$ref   = urlencode($_SERVER['REQUEST_URI']);
					$query = mysql_query("SELECT * FROM `mod_user` $QUERY ORDER BY `name` ASC LIMIT $offset,$limit");
					while($data = mysql_fetch_assoc($query)) {
						$warna 	= empty ($warna) ? ' style="background-color:#f4f4f8;"' : '';
						$status = ($data['active'] == 1) ? '<a class="enable" href="?mod=users&amp;action=pub&amp;pub=no&amp;id='.$data['id'].'&amp;referer='.$ref.'" title="Enable">Enable</a>' : '<a class="disable" href="?mod=users&amp;action=pub&amp;pub=yes&amp;id='.$data['id'].'&amp;referer='.$ref.'" title="Disable">Disable</a>';												
						$tengah .= '<tr'.$warna.'><td class="center">'.$no.'</td><td class="left">'.$data['name'].'</td><td style="text-align: center;">'.$data['email'].'</td><td style="text-align: center;">'.$data['level'].'</td><td style="text-align: center;">'.$status.'</td><td style="text-align:center;"><a class="edit" href="admin.php?mod=users&amp;action=edit&amp;id='.$data['id'].'&amp;referer='.$ref.'">Edit</a> <a class="delete" href="admin.php?mod=users&amp;action=delete&amp;id='.$data['id'].'&amp;referer='.$ref.'" onclick="return confirm(\'Apakah anda yakin ?\')">Delete</a></td></tr>';
						$no++;
					}
					$tengah .= '
					</tbody>
					</table>
					</div>';
					$tengah .= $a-> getPaging($jumlah, $pg, $stg);

	}elseif($_GET['aksi'] =='jb'){

		$tengah .= '
		<div class="box">
		<h2 class="widget-title">Diagram <span class="styled1">Jaringan</span></h2>
		<div class="breadcrumb"><a href="member.php?mod=diagram" id="home">Ringkasan Jaringan</a>   &nbsp;&raquo;&nbsp;   Diagram Jaringan Manager</div>
		</div>
					<div class="border rb">
					<table class="list">
					<thead>
						<tr class="head">
							<td style="text-align: center;">No.</td>
							<td style="text-align: left;">Name</td>
							<td style="text-align: center;">Email</td>
							<td style="text-align: center;">Level</td>
							<td style="text-align: center;">Status</td>
							<td style="text-align: center;">Action</td>
						</tr>
					</thead>
					<tbody>';
					
					if (isset($_POST['search'])){
						$search = cleantext($_POST['search']);
						$QUERY =  "WHERE `username` LIKE '%$search%' OR `name` LIKE '%$search%' OR `email` LIKE '%$search%'";
					}else{
						$QUERY = "";
					}
					
					$jqa 	= $db->sql_query("SELECT * FROM `mod_user` $QUERY ORDER BY `name` ASC");
					$jumlah = $db->sql_numrows($jqa);
					$limit 	= 30;							
					$a 		= new paging ($limit);

					if(isset($offset)){
						$no = $offset + 1;
					}else{
						$no = 1;
					}
				
					$ref   = urlencode($_SERVER['REQUEST_URI']);
					$query = mysql_query("SELECT * FROM `mod_user` $QUERY ORDER BY `name` ASC LIMIT $offset,$limit");
					while($data = mysql_fetch_assoc($query)) {
						$warna 	= empty ($warna) ? ' style="background-color:#f4f4f8;"' : '';
						$status = ($data['active'] == 1) ? '<a class="enable" href="?mod=users&amp;action=pub&amp;pub=no&amp;id='.$data['id'].'&amp;referer='.$ref.'" title="Enable">Enable</a>' : '<a class="disable" href="?mod=users&amp;action=pub&amp;pub=yes&amp;id='.$data['id'].'&amp;referer='.$ref.'" title="Disable">Disable</a>';												
						$tengah .= '<tr'.$warna.'><td class="center">'.$no.'</td><td class="left">'.$data['name'].'</td><td style="text-align: center;">'.$data['email'].'</td><td style="text-align: center;">'.$data['level'].'</td><td style="text-align: center;">'.$status.'</td><td style="text-align:center;"><a class="edit" href="admin.php?mod=users&amp;action=edit&amp;id='.$data['id'].'&amp;referer='.$ref.'">Edit</a> <a class="delete" href="admin.php?mod=users&amp;action=delete&amp;id='.$data['id'].'&amp;referer='.$ref.'" onclick="return confirm(\'Apakah anda yakin ?\')">Delete</a></td></tr>';
						$no++;
					}
					$tengah .= '
					</tbody>
					</table>
					</div>';
					$tengah .= $a-> getPaging($jumlah, $pg, $stg);

	}elseif($_GET['aksi'] =='jpb'){

		$tengah .= '
		<div class="box">
		<h2 class="widget-title">Diagram <span class="styled1">Jaringan</span></h2>
		<div class="breadcrumb"><a href="member.php?mod=diagram" id="home">Ringkasan Jaringan</a>   &nbsp;&raquo;&nbsp;   Diagram Jaringan Manager</div>
		</div>
					<div class="border rb">
					<table class="list">
					<thead>
						<tr class="head">
							<td style="text-align: center;">No.</td>
							<td style="text-align: left;">Name</td>
							<td style="text-align: center;">Email</td>
							<td style="text-align: center;">Level</td>
							<td style="text-align: center;">Status</td>
							<td style="text-align: center;">Action</td>
						</tr>
					</thead>
					<tbody>';
					
					if (isset($_POST['search'])){
						$search = cleantext($_POST['search']);
						$QUERY =  "WHERE `username` LIKE '%$search%' OR `name` LIKE '%$search%' OR `email` LIKE '%$search%'";
					}else{
						$QUERY = "";
					}
					
					$jqa 	= $db->sql_query("SELECT * FROM `mod_user` $QUERY ORDER BY `name` ASC");
					$jumlah = $db->sql_numrows($jqa);
					$limit 	= 30;							
					$a 		= new paging ($limit);

					if(isset($offset)){
						$no = $offset + 1;
					}else{
						$no = 1;
					}
				
					$ref   = urlencode($_SERVER['REQUEST_URI']);
					$query = mysql_query("SELECT * FROM `mod_user` $QUERY ORDER BY `name` ASC LIMIT $offset,$limit");
					while($data = mysql_fetch_assoc($query)) {
						$warna 	= empty ($warna) ? ' style="background-color:#f4f4f8;"' : '';
						$status = ($data['active'] == 1) ? '<a class="enable" href="?mod=users&amp;action=pub&amp;pub=no&amp;id='.$data['id'].'&amp;referer='.$ref.'" title="Enable">Enable</a>' : '<a class="disable" href="?mod=users&amp;action=pub&amp;pub=yes&amp;id='.$data['id'].'&amp;referer='.$ref.'" title="Disable">Disable</a>';												
						$tengah .= '<tr'.$warna.'><td class="center">'.$no.'</td><td class="left">'.$data['name'].'</td><td style="text-align: center;">'.$data['email'].'</td><td style="text-align: center;">'.$data['level'].'</td><td style="text-align: center;">'.$status.'</td><td style="text-align:center;"><a class="edit" href="admin.php?mod=users&amp;action=edit&amp;id='.$data['id'].'&amp;referer='.$ref.'">Edit</a> <a class="delete" href="admin.php?mod=users&amp;action=delete&amp;id='.$data['id'].'&amp;referer='.$ref.'" onclick="return confirm(\'Apakah anda yakin ?\')">Delete</a></td></tr>';
						$no++;
					}
					$tengah .= '
					</tbody>
					</table>
					</div>';
					$tengah .= $a-> getPaging($jumlah, $pg, $stg);

	}
	
echo $tengah;
?>