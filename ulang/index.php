<?php
ob_start();
include"koneksi.php";
if(!isset($_SESSION['user'])){
	session_start();
}
$pesan	="warning message";
if(isset($_POST['username'])){
	$user	= strip_tags(trim($_POST['username']));
	$pass	= strip_tags(trim($_POST['password']));
	$pass2	= sha1($pass);
	if(isset($_POST['remember'])){
		setcookie("username",$user,time() + (3600 * 24));
		setcookie("password",$pass,time() + (3600 * 24));
	}else{
		unset($_COOKIE['username']);
		unset($_COOKIE['password']);
	}
	 $sql	=mysql_query("select * from user where username='$user' and password='$pass2'");
	 $jml	=mysql_num_rows($sql);
	 $r		=mysql_fetch_array($sql);
	 if($jml > 0){
		 $_SESSION['user']=$r['username'];
		 $_SESSION['pass']=$r['password'];
		 $_SESSION['nama']=$r['nama'];
		 $_SESSION['level']=$r['level'];
		 $_SESSION['email']=$r['email'];
		 $_SESSION['foto']=$r['foto'];
		 if($r['level']=="admin" or $r['level']=="user"){
			 header("location:./admin/index.php");
		 }else{
			 header("location:home.php");
		 }
		 $pesan =  "username dan password valid";
	 }else{
		 $pesan	= "username dan password tidak valid";
	 }
}
mysql_close($koneksi);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Welcome</title>
<style>
.container{
	width:200px;
	height:auto;
	border:solid 1px lightgray;
	border-radius:3px;
	margin:0 auto;
}
#msglogin{
	width:90%;
	height:40px;
	border:solid 1px lightgray;	
	margin:0 auto;
	font-size:13px;
	margin-top:10px;
}
.container form{
	padding-left:9px;
	margin-top:10px;
}
.container input[type="text"],.container input[type="password"]{
	width:88%;
	height:30px;
	border:solid 1px lightgray;
    padding-left: 10px;
    margin-top: 5px;
}
.container button{
	width:45%;
	height:30px;
	margin-top:10px;
	margin-bottom:10px;
}
</style>
</head>
<body>
<div class="container">
<div id="msglogin">
<?php echo $pesan; ?>
</div>
<form action="" method="post" target="_self" enctype="multipart/form-data" name="login" id="login">
<input type="text" id="username" name="username" required placeholder="Username" value="<?php echo isset($_COOKIE['username'])?$_COOKIE['username']:''; ?>"><br>
<input type="checkbox" id="remember" name="remember"> Remeber Me<br>
<input type="password" id="password" name="password" required placeholder="Password" value="<?php echo isset($_COOKIE['password'])?$_COOKIE['password']:''; ?>">
<button type="submit" name="submit" id="submit">Submit</button>
<button type="reset" name="reset" id="reset" onClick="history.back()">Kembali</button>
</form>
</div>
</body>
</html>
<?php
ob_flush();
?>
