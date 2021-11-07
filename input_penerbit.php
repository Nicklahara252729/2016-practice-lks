<?php
ob_start();
include"koneksi.php";
if(isset($_POST['kode_penerbit'])){
	$kode_penerbit	= strip_tags(trim($_POST['kode_penerbit']));
	$nama_penerbit	= strip_tags(trim($_POST['nama_penerbit']));
	$alamat			= strip_tags(trim($_POST['alamat']));
	$nomor			= strip_tags(trim($_POST['telp']));
	$email			= strip_tags(trim($_POST['email']));
	$web			= strip_tags(trim($_POST['web']));
	
	$halaman		= $_GET['hal'];
	
	$sql		= mysql_query("select * from penerbit where kode_penerbit='$kode_penerbit'");
	$jmldata	= mysql_num_rows($sql);
	if($jmldata > 0){
		?>
        <script>alert('penerbit sudah ada'); history.back();</script>
        <?php
	}else{
		$save	= mysql_query("insert into penerbit set kode_penerbit='$kode_penerbit', nama_penerbit='$nama_penerbit', alamat='$alamat', telp='$nomor', email='$email', website='$web'");
		if($halaman=="tampil"){
			header("location:tampilpenerbit.php");
		}
		else if($halaman=="buku"){
			header("location:input_buku.php");
		}else if($halaman=="edit"){
			header("location:edit_buku.php");
		}
	}
}
mysql_close($koneksi);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Input Penerbit</title>
<link href="css/style.css" rel="stylesheet">
</head>

<body>
<main>
<form action="" method="post" target="_self" enctype="multipart/form-data" id="input_penerbit" name="input_penerbit">
<label for="kode_penerbit">Kode Penerbit :</label><br>
<input type="text" id="kode_penerbit" name="kode_penerbit" placeholder="Kode Penerbit" required>
<label for="nama_penerbit">Nama Peberbit :</label><br>
<input type="text" id="nama_penerbit" name="nama_penerbit" placeholder="Nama Penerbit" required> 
<label for="alamat">Alamat :</label><br>
<textarea name="alamat" id="alamat" placeholder="Alamat"></textarea>
<label for="telp">Nomor Telepon :</label><br>
<input type="text" name="telp" id="telp" required placeholder="Nomor Telepon">
<label for="email">Email :</label><br>
<input type="email" name="email" id="email" required placeholder="Email">
<label for="web">Website :</label><br>
<input type="url" name="web" id="web" placeholder="Website" value="http://">
<button type="submit" name="submit" id="submit">Simpan</button>
<button type="reset" id="reset" name="reset" onClick="history.back();">Batalkan</button>
</form>
</main>
</body>
</html>
<?php
ob_flush();
?>