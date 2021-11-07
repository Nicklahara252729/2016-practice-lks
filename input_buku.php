<?php
ob_start();
include"koneksi.php";
	$sql_penulis	= mysql_query("select * from penulis  order by nama asc");
	$sql_penerbit	= mysql_query("select * from penerbit order by nama_penerbit asc");
	$sql_kategori	= mysql_query("select * from kategori order by kategori asc");
	$jml_penulis	= mysql_num_rows($sql_penulis);
	$jml_penerbit	= mysql_num_rows($sql_penerbit);
	//$data_penulis	= mysql_fetch_assoc($sql_penulis);
	//$data_penerbit	= mysql_fetch_array($sql_penerbit);
	//echo $jml_penulis;
if(isset($_POST['isbn'])){
	$isbn			= strip_tags(trim($_POST['isbn']));
	$judul			= strip_tags(trim($_POST['judul']));
	$sinopsis		= strip_tags(trim($_POST['sinopsis']));
	$thn_terbit		= strip_tags(trim($_POST['tahun_terbit']));
	$kode_penulis	= strip_tags(trim($_POST['kode_penulis']));
	$kode_penerbit	= strip_tags(trim($_POST['kode_penerbit']));
	$stok			= strip_tags(trim($_POST['stok']));
	$harga			= strip_tags(trim($_POST['harga']));
	$kategori		= strip_tags(trim($_POST['kategori']));
	$gambar			= $_FILES['gambar']['name']?$_FILES['gambar']['name']:"2ign.jpg";
	
	$sql			= mysql_query("select * from buku where isbn='$isbn'");
	$jml 			= mysql_num_rows($sql);
	if($jml > 0){
		?>
        <script> alert('Data dengan isbn <?php echo $isnb; ?> sudah ada'); history.back();</script>
        <?php		
	}else{
		$simpan		= mysql_query("insert into buku set isbn='$isbn',judul='$judul',sinopsis='$sinopsis',tahun_terbit='$thn_terbit',kode_penulis='$kode_penulis',kode_penerbit='$kode_penerbit',stok='$stok',harga='$harga',gambar='$gambar',kategori='$kategori'");
		if($simpan && isset($_FILES['gambar']['name'])){
			move_uploaded_file($_FILES['gambar']['tmp_name'],"img/".$gambar);
		}
		header("location:tampilbuku.php");
	}
 
}
mysql_close($koneksi);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Input Buku</title>
<link href="css/style.css" rel="stylesheet">
</head>

<body>
<main>
<form action="" method="post" enctype="multipart/form-data" id="input_buku" name="input_buku" target="_self">
<label for="isbn">ISBN Buku :</label><br>
<input type="text" id="isbn" name="isbn" required placeholder="ISBN">
<label for="judul">Judul Buku :</label>
<input type="text" id="judul" name="judul" required placeholder="Judul Buku">
<label for="judul">Sinopsis Buku :</label>
<textarea name="sinopsis" placeholder="Sinopsis" id="sinopsis"></textarea>
<label for="tahun_terbit">Tahun Terbit :</label><br>
<select name="tahun_terbit" id="tahun_terbit">
<option disabled>-- Pilih Tahun Terbit --</option>
<?php
for($i=1999;$i<=2016;$i++){
	echo"<option value='$i'>$i</option>";
}
?>
</select><br>
<label for="kode_penulis">Nama Penulis :</label><br>
<select name="kode_penulis" id="kode_penulis">
<option>- Pilih Penulis -</option>
<?php
while($data_penulis	= mysql_fetch_assoc($sql_penulis)){
	?>
    <option value="<?php echo $data_penulis['kode_penulis'];?>"><?php echo $data_penulis['nama']; ?></option>
    <?php
}
?>
</select> <button type="button" name="tambah_penulis" id="tambah_penulis" title="Tambah Penulis" onClick="location.href='input_penulis.php?hal=buku'">+</button><br>
<label for="kode_penerbit">Nama Penerbit :</label>
<select name="kode_penerbit" id="kode_penerbit">
<option>- Pilih Salah Satu -</option>
<?php
while($data_penerbit=mysql_fetch_assoc($sql_penerbit)){
	?>
    <option value="<?php echo $data_penerbit['kode_penerbit']; ?>"><?php echo $data_penerbit['nama_penerbit']; ?></option>
    <?php
}
?>
</select> <button type="button" name="tambah_penerbit" id="tambah_penerbit" title="Tambah Penulis" onClick="location.href='input_penerbit.php?hal=buku'">+</button><br>
<label for="stok">Stok Buku :</label>
<input type="number" id="stok" name="stok" placeholder="Stok Buku" required>
<label for="Harga">Harga Buku :</label>
<input type="number" min="10000" max="500000" id="harga" name="harga" placeholder="Harga Buku" required>
<label for="kategori">Kategori :</label>
<select name="kategori">
<option>- Pilih Kategori -</option>
<?php
while($data_kategori=mysql_fetch_assoc($sql_kategori)){
	?>
    <option value="<?php echo $data_kategori['kategori']; ?>"><?php echo $data_kategori['kategori']; ?></option>
    <?php
}
?>
</select>
<label for="Gambar">Gambar :</label>
<input type="file" id="gambar" name="gambar">
<button type="submit" name="submit" id="submit">Simpan Data</button>
<button type="reset" id="reset" name="reset" onClick="history.back();">Batalkan</button>
</form>
</main>
</body>
</html>
<?php
ob_flush();
?>