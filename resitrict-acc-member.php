<?php
/*ob_start();
if(!isset($_SESSION['user'])){
	session_start();
}
if(isset($_SESSION['user'])){
	$level=$_SESSION['level'];
}else{
	$level="umum";
}
if($level=="admin" or $level=="user" or $level=="member"){

}
else{
	*/
?>
<!docytpe html>
<html>
<head>

<style>
.container{
	width:50%;
	height:200px;
	border:solid 1px;
	margin:0 auto;
	text-wrap:normal;
}
button{
}
</style>
</head>
<body>
<div class="container">
<b>Peringatan : </b> <font color="red">Maaf anda tidak berhak mengakses halaman ini. Anda harus berstatus sebagai member, silahkan registrasi atau login terlebih dahulu</font>
<?php echo isset($_GET['level'])?$_GET['level']:'Administrator'; ?>
<button type="button" onClick="history.back();">Kembali</button>
<button type="button" onClick="location.href='login.php'">Login</button>
</div>
</body>
</html>
<?php
/*}
ob_flush();*/
?>