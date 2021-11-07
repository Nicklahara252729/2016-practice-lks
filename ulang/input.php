<?php
include"koneksi.php";
if(!isset($_SESSION['user'])){
	session_start();
}
if(isset($_SESSION['user'])){
if(isset($_POST['username'])){
	$nama	= strip_tags(trim($_POST['nama']));
	$user	= strip_tags(trim($_POST['username']));
	$pass	= sha1(strip_tags(trim($_POST['password'])));
	$email	= strip_tags(trim($_POST['email']));
	$level	= strip_tags(trim($_POST['level']));
	$foto	= $_FILES['foto']['name']?$_FILES['foto']['name']:"2ign.jpg";
	$size	= $_FILES['foto']['size'];
	$sql	= mysql_query("select * from user where username='$user'");
	$jml	= mysql_num_rows($sql);
	if($jml > 0){
		?>
        <script>alert('username <?php echo $user; ?> sudah ada');
        history.back();</script>
        <?php
	}else{
		$simpan	= mysql_query("insert into user set nama='$nama', username='$user', password='$pass', email='$email', level='$level', foto='$foto'");
		if($simpan && isset($_FILES['foto']['name'])){
			move_uploaded_file($_FILES['foto']['tmp_name'],"img/".$foto);
		}
	}
}
mysql_close($koneksi);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>welcome admin <?php ?></title>
<script>
function cekpass(){
	var pass = document.getElementById('password').value;
	var pass1= document.getElementById('password').value;
	var pass2= document.getElementById('confirm').value;
	if(pass.length < 8 && pass1!=pass2){
		document.getElementById('msgpass').style.color="red";
		document.getElementById('msgpass').innerHTML="harus panjang";
		document.getElementById('password').focus();
		return false;
	}
	else if(pass.length>=8 && pass2.length<=0){
		document.getElementById('msgpass').style.color="green";
		document.getElementById('msgpass').innerHTML="good pass";
	}
	else if(pass.length>=8 && pass1!=pass2){
		document.getElementById('msgpass').style.color="red";
		document.getElementById('msgpass').innerHTML="not same";
		document.getElementById('confirm').focus();
		return false;
	}
	else if(pass.length>=8 && pass1==pass2){
		document.getElementById('msgpass').style.color="blue";
		document.getElementById('msgpass').innerHTML="match";
	}
}
function cekfile(){
	var filein= document.getElementById('foto');
	var info= filein.files[0];
	var size= info.size;
	var pembulatan_mb = Math.round(size / 1048576);
	var pembulatan_kb= Math.round(size /1024);
	if(size > 2097152){
		document.getElementById('msgfoto').style.color="red";
		document.getElementById('msgfoto').innerHTML="terlalu besar " + (pembulatan_mb)+" mb";
		document.getElementById('msgfoto').focus();
		return false;
	}else{
		document.getElementById('msgfoto').style.color="blue";
		document.getElementById('msgfoto').innerHTML="diterima " +( pembulatan_kb)+" kb";
	}
}
</script>
</head>

<body>
<div class="container">
<form action="" method="post" enctype="multipart/form-data" name="input" id="input" target="_self">
<input type="text" name="nama" id="nama" placeholder="Masukkan Nama" required><br>
<input type="text" name="username" id="username" placeholder="Masukkan username" required><br>
<input type="password" name="password" id="password" placeholder="Masukkan Password" required onBlur="cekpass()"><br>
<input type="password" name="confirm" id="confirm" placeholder="Confirm Password" required onBlur="cekpass()" onFocus="cekpass()"><br>
<div id="msgpass"></div><br>
<input type="text" name="email" id="email" placeholder="Masukkan email" required onFocus="cekpass()"><br>
<select name="level" id="level">
<?php
$status=array('admin','user','member');
for($i=0;$i<=2;$i++){
	echo"<option value='$status[$i]'>$status[$i]</option>";
}
?>
</select><br>
<input type="file" name="foto" id="foto" onFocus="cekfile()" onChange="cekfile()">
<div id="msgfoto"></div><br>
<button type="submit" id="submit" name="submit">Submit</button>
<button type="reset" id="reset" name="reset" onClick="history.back()">Cancel</button>
</form>
<?php 
}else{
	header("location:index.php");
}
$ip_no		=$_SERVER['REMOTE_ADDR'];
$host_name	=gethostbyaddr($_SERVER['REMOTE_ADDR']);
echo $ip_no;
echo $host_name;
ob_flush();
?>
</div>
</body>
</html>