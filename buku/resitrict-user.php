<?php
ob_start();
if(!isset($_SESSION['user'])){
	session_start();
}
if(!isset($_SESSION['user'])){
	header("location:../buku/resitrict.php?level=admin atau user");
	exit();
}else{
	$level= $_SESSION['level'];
	if(!($level=="admin" or $level=="user")){
		header("location:../buku/resitrict.php?level=admin atau user");
		exit();
	}
}
ob_flush();
?>