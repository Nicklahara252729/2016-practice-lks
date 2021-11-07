<?php
$koneksi = mysqli_connect("localhost","root","") or die(mysql_error());
$database	= mysqli_select_db($koneksi,"penjualan") or die(mysql_error());
?>