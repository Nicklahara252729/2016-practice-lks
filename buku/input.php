<?php
ob_start();
include"koneksi.php";
include"resitrict-user.php";
if(isset($_POST['username'])){
	$nama	= strip_tags(trim($_POST['nama']));
	$user	= strip_tags(trim($_POST['username']));
	$pass	= sha1(strip_tags(trim($_POST['password'])));
	$level	= strip_tags(trim($_POST['level']));
	$email	= strip_tags(trim($_POST['email']));
	$foto	= $_FILES['foto']['name']?$_FILES['foto']['name']:"2ign.jpg";
	$size	= $_FILES['foto']['size'];
	$sql	= mysql_query("select * from user where username='$user'");
	$jml	= mysql_num_rows($sql);
	if($jml > 0){
		?>
        <script>alert('username <?php echo $user; ?> sudah ada');</script>
        <?php
	}else{
		$simpan	= mysql_query("insert into user set nama='$nama', username='$user', password='$pass', email='$email', level='$level',foto='$foto'");
		if($simpan && isset($_POST['foto']['name'])){
			move_uploaded_file($_POST['foto']['tmp_name'],"img/".$foto);
		}
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin <?php echo"admin"; ?></title>
<script>
function cekpass(){
	var pass = document.getElementById('password').value;
	var pass1 = document.getElementById('password').value;
	var pass2 = document.getElementById('confirm').value;
	if(pass.length<8 && pass1!=pass2){
		document.getElementById('msgpass').style.color="red";
		document.getElementById('msgpass').innerHTML="must long";
		document.getElementById('password').focus();
		return false;
	}
	else if(pass.length >=8 && pass2.length<=0){
		document.getElementById('msgpass').style.color="green";
		document.getElementById('msgpass').innerHTML="good";
	}
	else if(pass.length >=8 && pass1!=pass2){
		document.getElementById('msgpass').style.color="red";
		document.getElementById('msgpass').innerHTML="not same";
		document.getElementById('confirm').focus();
		return false;
	}
	else if(pass.length >=8 && pass1==pass2){
		document.getElementById('msgpass').style.color="blue";
		document.getElementById('msgpass').innerHTML="match";
	}
}
	function cekfoto(){
		var filein	= document.getElementById('foto');
		var info	= filein.files[0];
		var size	= info.size;
		var kbsize	= Math.round(size / 1024);
		var mbsize	= Math.round(size / 1048576);
		if(size > 2097152){
			document.getElementById('msgfoto').style.color="red";
			document.getElementById('msgfoto').innerHTML="terlalu besar " + (mbsize) +" kb";
			document.getElementById('msgfoto').focus();
			return false;
		}else{
			document.getElementById('msgfoto').style.color="blue";
			document.getElementById('msgfoto').innerHTML="diterima " + (kbsize) +" kb";
		}
}
</script>
<style>
.container{
	width:200px;
	height:auto;
	border:solid 1px lightgray;
}
</style>
</head>

<body>
<div class="container">
<form action="" method="post" id="input" name="input" enctype="multipart/form-data" target="_self">
<input type="text" id="nama" name="nama" required placeholder="Nama Lengkap">
<input type="text" id="username" name="username" required placeholder="Username">
<input type="password" id="password" name="password" required placeholder="Password" onBlur="cekpass()">
<input type="password" id="confirm" name="confirm" required placeholder="Confirm Password" onBlur="cekpass()" onFocus="cekpass()">
<div id="msgpass"></div><br>
<label for="lev">Pilih Hak Akses</label><br>
<select name="level" id="level">
<?php
$lev	=array('admin','user','member');
for($i=0;$i<=2;$i++){
	echo"<option value='$lev[$i]'>$lev[$i]</option>";
}
?>
</select>
<input type="text" id="email" name="email" required placeholder="Masukkan Email" onFocus="cekpass()">
<input type="file" name="foto" id="foto" onFocus="cekfoto();" onChange="cekfoto();">
<div id="msgfoto"></div><br>
<button type="submit" name="submit" id="submit">Simpan Data</button>
<button type="reset" id="reset" name="reset" onClick="history.back()">Kembali</button>
</form>
</div>
</body>
</html>
<?php
ob_flush();
?>