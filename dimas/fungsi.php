<?php
function kandidat_by_kode($kode,$opt = 'nama'){
	$query_kandidat = mysql_query("SELECT * FROM kandidat WHERE kode='$kode'");
	$data_kandidat = mysql_fetch_object($query_kandidat);
	return $data_kandidat->$opt;
}

function kriteria_by_kode($kode,$opt = 'nama'){
	$query_kriteria = mysql_query("SELECT * FROM kriteria WHERE kode='$kode'");
	$data_kriteria = mysql_fetch_object($query_kriteria);
	return $data_kriteria->$opt;
}

function rmax($n1,$n2){	
	if( $n1 < $n2 ) $n = $n2;
	else $n = $n1;
	return $n;
}

function nmax($n){
	$n1 = rmax($n[0],$n[1]);
	$n2 = rmax($n[2],$n[3]);
	$n3 = rmax($n1,$n2);
	return $n3;
}

function normalisasi($x,$y){
	$n = $x/max($y); //$n = $x/nmax($y);
	return $n;
}

function normalisasi_lanjut($nx = 0,$ny = 0){	
	$query_nilai = mysql_query("SELECT * FROM nilai ORDER BY `nilai_id` ASC LIMIT $nx,1");
	$data_nilai = mysql_fetch_object($query_nilai);
	
	$query_nilaic = mysql_query("SELECT * FROM `nilai` ORDER BY `nilai_id` ASC LIMIT $ny,4");
	$y = array();
	while( $data_nilaic = mysql_fetch_object($query_nilaic) ){
		$y[] = $data_nilaic->angka;
	}
	$r = normalisasi($data_nilai->angka,$y); 
	return $r;
}

function perkalian_matrik($n1,$n2,$n3,$n4){
	$n = ($n1 * 35/100) + ($n2 * 25/100) + ($n3 * 25/100) + ($n4 * 15/100);
	return $n;
}