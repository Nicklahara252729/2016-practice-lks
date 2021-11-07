<?php
include"koneksi.php";
$sql = mysql_query("select * from pembelian");
$r = mysql_fetch_array($sql);
$date  = $r['tgl_pembelian'];
$tahun = substr($date,0,4);
$bulan = substr($date,5,2);
$tgl = substr($date,8,2);
$b = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
echo $tahun ." / ".$b[(int)$bulan]." / ".$tgl    ;
?>