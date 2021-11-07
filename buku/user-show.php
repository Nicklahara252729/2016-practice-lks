<?php
ob_start();
if(!isset($_SESSION['user'])){
	session_start();
}
if(isset($_SESSION['user'])){
	$user	= $_SESSION['user'];
	$level	= $_SESSION['level'];
	$pass	= $_SESSION['pass'];
	$email	= $_SESSION['email'];
	$foto	= $_SESSION['foto'];
	$nama	= $_SESSION['nama'];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Welcome <?php echo $user; ?></title>
<style>
.container{
	width:250px;
	height:80px;
	border:solid 1px lightgray;
}
.content{
	height:100%;
	float:left;
}
#left{
	width:30%;
}
#right{
	width:70%;
	background:#FBFBFB;
}
.isi{
	width:100%;
	height:50%;
}
#isi-satu{
	border-bottom:solid 1px lightgray;
}
</style>
</head>

<body>
<div class="container">
<div class="content" id="left"></div>
<div class="content" id="right">
<div class="isi" id="isi-satu">
<?php echo $nama;?>
</div>
<div class="isi">
Status : <?php echo $level; ?> | <a href="../buku/logout.php">LOGOUT</a>
</div>
</div>
</div>
</body>
</html>
<?php
}else{
	header("location:index.php");
}
ob_flush();
?>