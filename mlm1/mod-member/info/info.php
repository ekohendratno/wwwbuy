<?php

	if(!defined('MEMBER')) exit;

	if (!cek_login ()) exit;

	$tengah  = '';
	
	
	
	if($_GET['aksi'] =='' || $_GET['aksi'] =='jd'){

		$tengah .= '
		<div class="box">
		<h2 class="widget-title">Jumlah <span class="styled1">Downline</span></h2>
		<div class="breadcrumb"><a href="member.php?mod=info" id="home">Info Mitra</a>   &nbsp;&raquo;&nbsp;   Jumlah Downline</div>
		</div>
					<table class="list">
					<thead>
						<tr class="head">
							<td style="text-align: center;">#</td>
							<td style="text-align: center;">Downline kiri</td>
							<td style="text-align: center;">Downline kanan</td>
						</tr>
					</thead>
					<tbody>';										
						$tengah .= '<tr'.$warna.'>
						<td class="center">1</td>
						<td class="center">2</td>
						<td class="center">2</td>
						</tr>';
					$tengah .= '
					</tbody>
					</table>';
				

	}
	
echo $tengah;
?>