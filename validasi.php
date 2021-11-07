<?php
include"koneksi.php";
include"valid-page-member.php";
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
        <script>alert('username <?php echo $user; ?> sudah ada'); history.back();</script>
        <?php
	}else{
		if($size > 100){
			?>
            <script>alert('terlalu besar'); history.back();</script>
            <?php
		}
		$simpan=mysql_query("insert into user set nama='$nama', username='$user', password='$pass', email='$email', level='$level', foto='$foto'");
		if($simpan && isset($_FILES['foto']['name'])){
			move_uploaded_file($_FILES['foto']['tmp_name'],"img/".$foto);
		}
	}
}
mysql_close($koneksi);
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, height=device-height, user-scalable=no, maximum-scale=1, minimum-scale=1">
<meta  charset="utf-8">
<title>validasi</title>
<script>
function cekpass(){
	var pass=document.getElementById('password').value;
	var pass1=document.getElementById('password').value;
	var pass2=document.getElementById('confirm').value;
if(pass.length<8 && pass1!=pass2){
	document.getElementById('msgpass').style.color="red";
	document.getElementById('msgpass').innerHTML="must long";
	document.getElementById('password').focus();
	return false;
}
else if(pass.length>=8 && pass2.length<=0){
	document.getElementById('msgpass').style.color="green";
	document.getElementById('msgpass').innerHTML="pass good";
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
function cekfoto(){
	var filein =document.getElementById('foto');
	var info   =filein.files[0];
	var size   =info.size;
	var pembulatan_mb = Math.round(size / 1048576);
	var pembulatan_kb= Math.round(size /1024);
	if(size > 2097152){
		document.getElementById('msgfoto').style.color="red";
		document.getElementById('msgfoto').innerHTML="terlalu besar "+(pembulatan_mb)+" mb";
		document.getElementById('msgfoto').focus();
		return false;
	}else{
		document.getElementById('msgfoto').style.color="blue";
		document.getElementById('msgfoto').innerHTML="diterima "+(pembulatan_kb)+" kb";
	}
}
</script>
</head>
<body>
<?php include("show-user.php");?>
<form id="input" name="input" action="#" method="post" enctype="multipart/form-data" target="_self">
<label for="nama">Masukkan Nama :</label><br>
<input type="text" name="nama" id="nama" placeholder="Masukkan Nama" required><br>
<label for="username">Username :</label><br>
<input type="text" name="username" id="username" placeholder="Username" required><br>
<label for="password">Password :</label><br>
<input type="password" name="password" id="password" placeholder="Password" required onBlur="cekpass()"><br>
<label for="confirm">Confirm :</label><br>
<input type="password" name="confirm" id="confirm" placeholder="Confirm Password" required onBlur="cekpass()" onFocus="cekpass()"><br>
<div id="msgpass"></div><br>
<label for="email">Email :</label><br>
<input type="text" name="email" id="email" placeholder="Email" required onFocus="cekpass()"><br>
<label for="level">Pilih Hak Akses :</label><br>
<select name="level" id="level">
<?php
$level=array('admin','member','user');
for($i=0;$i<=2;$i++){
	?>
    <option value="<?php echo $level[$i] ?>"><?php echo $level[$i]; ?></option></option>
    <?php
}
?>
</select><br>
<label for="Foto">Foto</label><br>
<input type="file" name="foto" id="foto" onFocus="cekfoto()" onChange="cekfoto()"><br>
<div id="msgfoto"></div><br>
<button type="submit" id="submit" name="submit">Simpan Data</button>
<button type="reset" id="reset" name="reset" onClick="history.back()">Batalkan</button>
</form>
</body>
</html>