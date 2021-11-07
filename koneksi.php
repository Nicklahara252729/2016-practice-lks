<?php
$koneksi=mysql_connect('localhost','root','') or die('koneksi error'.mysql_error());
mysql_select_db('siswa',$koneksi) or die('database tidak terkoneksi'.mysql_error());
?>