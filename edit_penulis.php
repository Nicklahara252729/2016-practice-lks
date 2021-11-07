<?php
ob_start();
include"koneksi.php";
include"valid-page-user.php";
if(isset($_GET['kode_penulis'])){
	$kode			= $_GET['kode_penulis'];
	$sql_penulis	= mysql_query("select * from penulis where kode_penulis='$kode'");
	$r				= mysql_fetch_array($sql_penulis);
	$jml_penulis	= mysql_num_rows($sql_penulis);	
	if($jml_penulis <=0){
		?>
        <script>alert('Data tidak ditemukan'); history.back();</script>
        <?php
	}
}

if(isset($_POST['kode_penulis'])){
	$kode_penulis	= strip_tags(trim($_POST['kode_penulis']));
	$nama_penulis	= strip_tags(trim($_POST['nama_penulis']));
	$alamat			= strip_tags(trim($_POST['alamat']));
	$sex			= strip_tags(trim($_POST['sex']));
	$telp			= strip_tags(trim($_POST['telp']));
	$email			= strip_tags(trim($_POST['email']));
	$foto			= $_FILES['foto']['name'];
	
	$sql			= mysql_query("select * from penulis where kode_penulis='$kode_penulis'");
	$jmldata		= mysql_num_rows($sql);
	if($jmldata <= 0){
		?>
        <script>alert('Data penulis tidak ditemukan'); history.back();</script>
        <?php
	}else{
		if(!empty($_FILES['foto']['name'])){
			$save	= mysql_query("update penulis set  nama='$nama_penulis', alamat='$alamat', sex='$sex', telp='$telp', email='$email', photo='$foto' where kode_penulis='$kode_penulis'");
			move_uploaded_file($_FILES['foto']['tmp_name'],"img/".$foto);
		}else{
			$save	= mysql_query("update penulis set  nama='$nama_penulis', alamat='$alamat', sex='$sex', telp='$telp', email='$email' where kode_penulis='$kode_penulis'");
		}
		header("location:tampilpenulis.php");
	}
	
}
mysql_close($koneksi);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Input Penulis</title>
<link href="css/style.css" rel="stylesheet">
<style>
main img{
	width:100px;
	height:100px;
}
</style>
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
<div class="registrasi">
<form action="" method="post" id="input_penulis" name="input_penulis" enctype="multipart/form-data" target="_self">
<label for="kode_penulis">Kode Penulis :</label>
<input type="text" id="kode_penulis" name="kode_penulis" required placeholder="Kode Penulis" value="<?php echo isset($r['kode_penulis'])?$r['kode_penulis']:''; ?>" readonly>
<label for="kode_penulis">Nama Penulis :</label>
<input type="text" id="nama_penulis" name="nama_penulis" required placeholder="Nama Penulis" value="<?php echo isset($r['nama'])?$r['nama']:''; ?>">
<label for="alamat">Alamat :</label><br>
<textarea name="alamat" id="alamat" placeholder="Alamat" ><?php echo isset($r['alamat'])?$r['alamat']:''; ?></textarea>
<label for="sex">Jenis Kelamin :</label><br>
<select name="sex" id="sex">
<option disabled>-- Pilih Jenis Kelamin</option>
<option value="L" <?php echo $r['sex']=='L'?'selected':''; ?>>laki - laki</option>
<option value="P" <?php echo $r['sex']=='P'?'selected':''; ?>>Perempuan</option>
</select>
<label for="telp">Nomor Telepon :</label><br>
<input type="text" id="telp" name="telp" placeholder="Telepon" required value="<?php echo isset($r['telp'])?$r['telp']:''; ?>">
<label for="email">Masukkan Email :</label><br>
<input type="email" id="email" name="email" placeholder="Masukkan Email" required value="<?php echo isset($r['email'])?$r['email']:''; ?>">
<label for="foto">Photo Lama :</label><br>
<img src="img/<?php echo $r['photo']; ?>">
<label for="foto">Photo Baru :</label><br>
<input type="file" name="foto" id="foto" onFocus="cekfoto();" onChange="cekfoto();" onBlur="cekfoto();" >
Maximal 1 Mb
<div id="msgfoto"></div><br>
<button type="submit" name="submit" id="submit" onFocus="cekfoto();">Simpan Data</button>
<button type="reset" name="reset" id="reset" onClick="history.back();">Batalkan</button>
</form> 

</div>
</main>
</body>
</html>
<?php
ob_flush();
?>