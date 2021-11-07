<?php
ob_start();
if(!isset($_SESSION['user'])){
	session_start();
}
if(isset($_SESSION['user'])){
	$user	= $_SESSION['user'];
	$nama	= $_SESSION['nama'];
	$level	= $_SESSION['level'];
	$foto	= $_SESSION['foto'];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>welcome <?php echo $nama; ?></title>
<style>
.container{
	width:200px;
	height:70px;
	border:solid 1px lightgray;
}
.content{
	height:100%;
	float:left;
}
#left{
	width:40%;
}
#right{
	width:60%;
}
#left img{
	width:100%;
	height:100%;
}
.isi-right{
	width:100%;
	height:50%;
}
</style>
</head>
<body>
<div class="container">
<div class="content" id="left">
<img src="../img/<?php echo $foto; ?>">
</div>
<div class="content" id="right">
<div class="isi-right">
<?php echo $nama; ?>
</div>
<div class="isi-right">
<?php echo $level; ?> | <a href="logout.php">logout	</a>
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