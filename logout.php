<?php
ob_start();
if(!isset($_SESSION['user'])){
	session_start();
}
$level = $_SESSION['level'];
unset($_SESSION['user']);
unset($_SESSION['pass']);
unset($_SESSION['nama']);
unset($_SESSION['level']);
unset($_SESSION['foto']);
session_destroy();
if($level=='admin' or $level=='user'){
	header("location:login.php");
}else{
	header("location:login.php");
}
ob_flush();
?>