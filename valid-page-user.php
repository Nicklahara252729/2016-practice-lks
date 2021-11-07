<?php
ob_start();
if(!isset($_SESSION)){
	session_start();
}
if(!isset($_SESSION['user'])){
	header("location:resitrict-acc-member.php?level=user atau admin");
	exit();
}else{
	$level=$_SESSION['level'];
	if(!($level=="user" or $level=="admin")){
		header("location:resitrict-acc-member.php?level=user atau admin");
		exit();
	}
}
?>
<?php
ob_flush();
?>