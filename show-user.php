<?php
ob_start();
if(!isset($_SESSION['user'])){
	session_start();
}
if(isset($_SESSION['user'])){
	$nama	=$_SESSION['nama'];
	$user	=$_SESSION['user'];
	$pass	=$_SESSION['pass'];
	$level	=$_SESSION['level'];
	$foto	=$_SESSION['foto'];		
?>

<!docytpe html>
<html>
<head>
<script>
window.setTimeout("waktu()",100);
function waktu(){
	var waktu = new Date();
	var jam = waktu.getHours();
	if (jam <= 9){
		document.getElementById('user').innerHTML="Selamat pagi " + "<?php echo $user; ?>";
	}
	else if(jam <=14){
		document.getElementById('user').innerHTML="Selamat siang " + "<?php echo $user; ?>";
	}
	else if(jam <=19){
		document.getElementById('user').innerHTML="Selamat sore " + "<?php echo $user; ?>";
	}
	else{
		document.getElementById('user').innerHTML="Selamat malam " + "<?php echo $user; ?>";
	}
}
</script>
<style>
.container{
	width:250px;
	height:50px;
	border:solid 1px lightgray;
}
.in{
	float:left;
	height:100%;
}
#foto{
	width:30%;
	background:#f8f8f8;
}
#desc{
	width:70%;

}
.in-desc{
	width:100%;
	height:50%;
}
#foto img{
	width:100%;
	height:100%;
}
</style>
<title>show user</title>
</head>
<body>

<div class="container">
<div class="in" id="foto">
<img src="img/<?php echo $foto;?>">
</div>
<div class="in" id="desc">
<div class="in-desc" id="user">

</div>
<div class="in-desc">
<?php echo"Status: ".$level;?> | <a href="logout.php">Logout</a>
</div>
</div>
</div>
</body>
</html>
<?php
}else{
	header("location:login.php");
}
ob_flush();
?>
