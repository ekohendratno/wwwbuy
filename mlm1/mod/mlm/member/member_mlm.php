<?php

if(!defined('MEMBER')) exit;
if (!cek_login ()) exit;
$script_include[] = '<script>
        $(function() {
            $( "#tab" ).tabs({
    			cookie: {
    				expires: 1
    			}
		    });
        });
    </script>';
$tengah  = '';
	
switch($_GET['aksi']){
default:
case 'data':



		$tengah .= '
		<div class="box">
		<h2 class="widget-title">Data</h2>
		</div>

        <div id="tabsetting">
		    <ul>
			    <li><a href="#setting-1">Profile Pengguna</a></li>
                <li><a href="#setting-2">Ubah Password</a></li>
			</ul>
            <div id="setting-1">x';
			$tengah .= '
            </div>
			<div id="setting-2">y';
			$tengah .= '
            </div>

        </div>';
break;
case'diagram':
$tengah .= '
		<div id="tabs">
			<ul>
				<li><a href="#tabs-2">Right Sidebar</a></li>
				<li><a href="#tabs-1">Left Sidebar</a></li>
			</ul>
			<form name="frm" id="frm"  method="post" action="" enctype ="multipart/form-data">
			<div id="tabs-1">
				<div class="border rb">
				<table class="list">
				<thead>
					<tr class="head">
						<td style="text-align: center;">Title</td>
						<td style="text-align: center;">Published</td>
						<td style="text-align: center;">Position</td>
						<td style="text-align: center;">Order</td>
						<td style="text-align: center;">Type</td>
						<td style="text-align: center;">Action</td>
					</tr>
				</thead>
				<tbody>';
				for($i=1;$i<=20;$i++) {
					$warna = empty ($warna) ? ' style="background-color:#f4f4f8;"' : '';
					
					$tengah .= '<tr'.$warna.'>
					<td class="left">'.$i.'</td>
					<td style="text-align: center;"></td>
					<td style="text-align: center;"></td>
					<td style="text-align: center;"></td>
					<td style="text-align: center;"></td>
					<td style="text-align:center;">
						<a class="edit" href="#">Edit</a> 
						<a class="delete" href="#" onclick="return confirm(\'Apakah anda yakin ?\')">Delete</a>
					</td>
					</tr>';
					
				}
				$tengah .= '
				</tbody>
				</table>
				</div>
			</div>
			<div id="tabs-2">
				<div class="border rb">
				<table class="list">
				<thead>
					<tr class="head">
						<td style="text-align: center;">Title</td>
						<td style="text-align: center;">Published</td>
						<td style="text-align: center;">Position</td>
						<td style="text-align: center;">Order</td>
						<td style="text-align: center;">Type</td>
						<td style="text-align: center;">Action</td>
					</tr>
				</thead>
				<tbody>';
				for($i=1;$i<=10;$i++) {
					$warna = empty ($warna) ? ' style="background-color:#f4f4f8;"' : '';
					
					$tengah .= '<tr'.$warna.'>
					<td class="left">'.$i.'</td>
					<td style="text-align: center;"></td>
					<td style="text-align: center;"></td>
					<td style="text-align: center;"></td>
					<td style="text-align: center;"></td>
					<td style="text-align:center;">
						<a class="edit" href="#">Edit</a> 
						<a class="delete" href="#" onclick="return confirm(\'Apakah anda yakin ?\')">Delete</a>
					</td>
					</tr>';
					
				}
				$tengah .= '
				</tbody>
				</table>
				</div>
			</div>
		</div>';

break;
case'info-mitra':



		$tengah .= '
		<div class="box">
		<h2 class="widget-title">Info Mitra</h2>
		</div>

        <div id="tabsetting">
		    <ul>
			    <li><a href="#setting-1">Total Bonus</a></li>
                <li><a href="#setting-2">Statemen Komisi</a></li>
                <li><a href="#setting-3">Jumlah Downline</a></li>
			</ul>
            <div id="setting-1">x';
			$tengah .= '
            </div>
			<div id="setting-2">y';
			$tengah .= '
            </div>
			<div id="setting-3">z';
			$tengah .= '
            </div>

        </div>';

break;
}
	
echo $tengah;
?>