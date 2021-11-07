<?php
ob_start();
include"koneksi.php";
include"valid-page-user.php";
if(isset($_GET['kode_penerbit'])){
	$kode			= $_GET['kode_penerbit'];
	$sql_penerbit	= mysql_query("select * from penerbit where kode_penerbit='$kode'");
	$r				= mysql_fetch_array($sql_penerbit);
	$jml_penerbit	= mysql_num_rows($sql_penerbit);	
	if($jml_penerbit <=0){
		?>
        <script>alert('Data tidak ditemukan'); history.back();</script>
        <?php
	}
}

if(isset($_POST['kode_penerbit'])){
	$kode_penerbit	= strip_tags(trim($_POST['kode_penerbit']));
	$nama_penerbit	= strip_tags(trim($_POST['nama_penerbit']));
	$alamat			= strip_tags(trim($_POST['alamat']));
	$telp			= strip_tags(trim($_POST['telp']));
	$email			= strip_tags(trim($_POST['email']));
	$web			= strip_tags(trim($_POST['web']));
	
	$sql			= mysql_query("select * from penerbit where kode_penerbit='$kode_penerbit'");
	$jmldata		= mysql_num_rows($sql);
	if($jmldata <= 0){
		?>
        <script>alert('Data penulis tidak ditemukan'); history.back();</script>
        <?php
	}else{
			$save	= mysql_query("update penerbit set  nama_penerbit='$nama_penerbit', alamat='$alamat', telp='$telp', email='$email', website='$web' where kode_penerbit='$kode_penerbit'");
		header("location:tampilpenerbit.php");
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

</head>

<body>
<main>
<form action="" method="post" id="input_penulis" name="input_penulis" enctype="multipart/form-data" target="_self">
<label for="kode_penerbit">Kode Penerbit :</label>
<input type="text" id="kode_penerbit" name="kode_penerbit" required placeholder="Kode Penerbit" value="<?php echo isset($r['kode_penerbit'])?$r['kode_penerbit']:''; ?>" readonly>
<label for="kode_penulis">Nama Penulis :</label>
<input type="text" id="nama_penerbit" name="nama_penerbit" required placeholder="Nama Penerbit" value="<?php echo isset($r['nama_penerbit'])?$r['nama_penerbit']:''; ?>">
<label for="alamat">Alamat :</label><br>
<textarea name="alamat" id="alamat" placeholder="Alamat" ><?php echo isset($r['alamat'])?$r['alamat']:''; ?></textarea>
<label for="telp">Nomor Telepon :</label><br>
<input type="text" id="telp" name="telp" placeholder="Telepon" required value="<?php echo isset($r['telp'])?$r['telp']:''; ?>">
<label for="email">Masukkan Email :</label><br>
<input type="email" id="email" name="email" placeholder="Masukkan Email" required value="<?php echo isset($r['email'])?$r['email']:''; ?>">
<label for="foto">Website :</label><br>
<input type="text" name="web" id="web" value="<?php echo isset($r['website'])?$r['website']:''; ?>" required>
<button type="submit" name="submit" id="submit" onFocus="cekfoto();">Simpan Data</button>
<button type="reset" name="reset" id="reset" onClick="history.back();">Batalkan</button>
</form> 
</main>
</body>
</html>
<?php
ob_flush();
?>