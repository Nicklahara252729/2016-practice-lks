<?php
ob_start();
include"koneksi.php";
if(isset($_POST['kode_penulis'])){
	$kode_penulis	= strip_tags(trim($_POST['kode_penulis']));
	$nama_penulis	= strip_tags(trim($_POST['nama_penulis']));
	$alamat			= strip_tags(trim($_POST['alamat']));
	$sex			= strip_tags(trim($_POST['sex']));
	$telp			= strip_tags(trim($_POST['telp']));
	$email			= strip_tags(trim($_POST['email']));
	$foto			= $_FILES['foto']['name']?$_FILES['foto']['name']:"2ign.jpg";
	
	$halaman		= $_GET['hal'];
	$sql			= mysql_query("select * from penulis where kode_penulis='$kode_penulis'");
	$jmldata		= mysql_num_rows($sql);
	if($jmldata > 0){
		?>
        <script>alert('penulis sudah ada'); history.back();</script>
        <?php
	}else{
		$save			= mysql_query("insert into penulis set kode_penulis='$kode_penulis', nama='$nama_penulis', alamat='$alamat', sex='$sex', telp='$telp', email='$email', photo='$foto'");
		if($save && isset($_FILES['foto']['name'])){
			move_uploaded_file($_FILES['foto']['tmp_name'],"img/".$foto);
		}
		if($halaman=="buku"){
			header("location:input_buku.php");
		}else if($halaman=="tampil"){
			header("location:tampilpenulis.php");
		}else if($halaman=="edit_buku"){
			header("location:edit_buku.php");
		}
	}
	
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Input Penulis</title>
<link href="css/style.css" rel="stylesheet">
<script>
function cekfoto(){
	var filein	= document.getElementById('foto');
	var info	= filein.files[0];
	var size	= info.size;
	var mbsize	= Math.round(size/1048576);
	var kbsize	= Math.round(size/1024);
	if(size > 1048576){
		document.getElementById('msgfoto').style.color="red";
		document.getElementById('msgfoto').innerHTML="File terlalu besar " + (mbsize) +" Mb";
		document.getElementById('msgfoto').focus();
		return false;
	}else{
		document.getElementById('msgfoto').style.color="blue";
		document.getElementById('msgfoto').innerHTML="File diterima " + (kbsize) +" Kb";
	}
}
</script>
</head>

<body>
<main>
<form action="" method="post" id="input_penulis" name="input_penulis" enctype="multipart/form-data" target="_self">
<label for="kode_penulis">Kode Penulis :</label>
<input type="text" id="kode_penulis" name="kode_penulis" required placeholder="Kode Penulis">
<label for="kode_penulis">Nama Penulis :</label>
<input type="text" id="nama_penulis" name="nama_penulis" required placeholder="Nama Penulis">
<label for="alamat">Alamat :</label><br>
<textarea name="alamat" id="alamat" placeholder="Alamat"></textarea>
<label for="sex">Jenis Kelamin :</label><br>
<select name="sex" id="sex">
<option disabled>-- Pilih Jenis Kelamin</option>
<option value="L">laki - laki</option>
<option value="P">Perempuan</option>
</select>
<label for="telp">Nomor Telepon :</label><br>
<input type="text" id="telp" name="telp" placeholder="Telepon" required>
<label for="email">Masukkan Email :</label><br>
<input type="email" id="email" name="email" placeholder="Masukkan Email" required>
<label for="foto">Photo</label><br>
<input type="file" name="foto" id="foto" onFocus="cekfoto();" onChange="cekfoto();" onBlur="cekfoto();">
Maximal 1 Mb
<div id="msgfoto"></div><br>
<button type="submit" name="submit" id="submit" onFocus="cekfoto();">Simpan Data</button>
<button type="reset" name="reset" id="reset" onClick="history.back();">Batalkan</button>
</form> 
</main>
</body>
</html>
<?php
ob_flush();
?>