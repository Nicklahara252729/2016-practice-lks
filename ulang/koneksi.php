<?php
$koneksi=mysql_connect('localhost','root','') or die (mysql_error());
mysql_select_db('siswa',$koneksi) or die(mysql_error());
?>