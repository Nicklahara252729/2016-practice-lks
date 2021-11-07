<?php
ob_start();
include"koneksi.php";
if(getenv('HTTP_X_FORWARDED_FOR')){
		$ip= getenv('HTTP_X_FORWARDED_FOR');
	}else{
		$ip=getenv('REMOTE_ADDR');
	}
if(isset($_GET['idupdate'])){
	$idupdate = $_GET['idupdate'];
	$sql_update =mysqli_query($koneksi,"select a.id_produk, a.nama_produk, a.harga_produk, a.kategori, a.gambar, b.ip_komputer,b.kode_produk, b.jumlah from produk a inner join keranjang b on a.id_produk=b.kode_produk where kode_produk='$idupdate' and ip_komputer='$ip'");
	$data_update = mysqli_fetch_array($sql_update);
	
if(isset($_POST['kode'])){
	$kode_ganti = $_POST['kode'];
	$ganti		= $_POST['ganti'];
	$sql_proses_update = mysqli_query($koneksi,"update keranjang set jumlah='$ganti' where ip_komputer='$ip' and kode_produk='$kode_ganti'");
	if($sql_proses_update){
		header("location:keranjang.php");
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<style>
main{
	width:50%;
	height:200px;
	margin:0 auto;
	border:solid 1px lightgray;
}
.content{
	float:left;
	height:100%;
}
#left{
	width:30%;
}
#left img{
	width:100%;
	height:100%;
}
#right{
	width:70%;
}
#right p{
	padding-left:10px;
}
</style>
</head>

<body>
<main>
<div class="content" id="left">
<img src="img/<?php echo $data_update['gambar']; ?>">
</div>
<div class="content" id="right">
<p><b>Nama Produk : <?php echo $data_update['nama_produk']; ?></b><br>
Harga Produk :<?php echo $data_update['harga_produk']; ?><br>
Kategori : <?php echo $data_update['kategori']; ?><br>
Jumlah Pemesanan : <form target="_self" enctype="multipart/form-data" name="ubah" id="ubah" method="post">
<input type="hidden" name="kode" id="kode" value="<?php echo $data_update['kode_produk']; ?>">
<input type="text" name="ganti" id="ganti" value="<?php echo $data_update['jumlah']; ?>">
<input type="submit" name="submit" id="submit" value="Update">
</form>
</p>
</div>
</main>
</body>
</html>
<?php
}
mysqli_close($koneksi);
ob_flush();
?>