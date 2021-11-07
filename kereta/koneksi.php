<?php
$koneksi = mysql_connect('localhost','root','') or die(mysql_error());
$db = mysql_select_db('kereta',$koneksi) or die(mysql_error());
?>