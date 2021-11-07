<?php
ob_start();
include"koneksi(3).php";
if(isset($_GET['sch_cari'])){
	$cari	= $_GET['sch_cari'];
	$sql	= mysqli_query($koneksi,"select * from produk where nama_produk like '%$cari%' order by nama_produk asc");
}else{
	$sql	= mysqli_query($koneksi,"select * from produk order by nama_produk asc");
}
	if(getenv('HTTP_X_FORWARDED_FOR')){
		$ip= getenv('HTTP_X_FORWARDED_FOR');
	}else{
		$ip=getenv('REMOTE_ADDR');
	}
if(isset($_GET['id_produk'])){
	$id_produk = $_GET['id_produk'];

	$sql_cekkeranjang= mysqli_query($koneksi,"select * from keranjang where ip_komputer='$ip'and kode_produk='$id_produk'");
	$jml_keranjang = mysqli_num_rows($sql_cekkeranjang);
	if($jml_keranjang > 0){
		$sql_keranjang = mysqli_query($koneksi,"update keranjang set jumlah=(jumlah + 1) where ip_komputer='$ip' and kode_produk='$id_produk'");
	}else{
	$sql_keranjang = mysqli_query($koneksi,"insert into keranjang set ip_komputer='$ip', kode_produk='$id_produk', jumlah='1'");
	}
}
$sql_hitung=mysqli_query($koneksi,"select sum(jumlah) as total from keranjang where ip_komputer='$ip'");
if($sql_hitung){
	$data_hitung = mysqli_fetch_array($sql_hitung);
	$jml_hitung=$data_hitung['total'];
}else{
	$jml_hitung=0;
}
$jml = mysqli_num_rows($sql);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="Shortcut Icon" href="img/favicon.gif" type="image/gif">
<title>Welcome</title>
<style>
body{
	background:#F1F1F1;
	font-family:"calibri";
}
main{
	width:90%;
	height:auto;
	border:solid 1px lightgray;
	margin:0 auto;
}
.header{
	width:100%;
	height:50px;
	background:white;
}
.content{
	width:100%;
	height:auto;
}
.produk{
	width:19%;
	height:300px;
	background: #fff;
	float:left;
	margin-right:10px;
	margin-top:10px;
}
.header input{
	width:200px;
	float:right;
	border:solid 1px lightgray;
	background:#f8f8f8;
	margin-top:10px;
	height:30px;
	margin-right:20px;
	padding-left:10px;
}
.gambar{
	width:100%;
	height:60%;
}
.produk p{
	padding-left:10px;
}
.ico-keranjang{
	width:30px;
	height:30px;
	position:absolute;
	margin-left:10px;
	margin-top:10px;
}

.ico-logo{
	width:20px;
	height:20px;
	margin-top:3px;
}
.detail,.beli{
	width:80px;
	text-decoration:none;
	color:white;
	height:30px;
	position:absolute;
	padding-left:10px;
	padding-right:10px;
	background:#144897;
	border-radius:3px;
	margin-top:10px;
}
.beli{
	margin-left:108px;
	background:green;
}
.keranjang{
	position:absolute;
	text-decoration:none;
	color:black;
}
</style>
</head>

<body>
<main>
<div class="header">
<a href="keranjang.php" class="keranjang"><img src="img/keranjang.png" class="ico-keranjang"><?php echo $jml_hitung; ?></a>
<form target="_self" name="cari" id="cari" enctype="multipart/form-data" method="get">
<input type="search" name="sch_cari" id="sch_cari" placeholder="Search" onKeyUp="this.submit();">
</form>
</div>
<div class="content">
<?php
if($jml > 0 ){
	while($r=mysqli_fetch_array($sql)){
?>
<div class="produk">

<img src="img/<?php echo $r['gambar'];?>" class="gambar">
<p><b><?php echo $r['nama_produk']; ?></b><br>
<?php echo"Rp." .number_format($r['harga_produk'],0,',','.'); ?><br>
<a href="" class="detail" name="detail"><img src="img/detail.png" class="ico-logo"> &nbsp; Detail</a>
<a href="tampilproduk.php?id_produk=<?php echo $r['id_produk']; ?>" class="beli" name="beli"><img src="img/kerajang-putih.png" class="ico-logo"> &nbsp; Beli</a>
</p>
</div>
<?php
	}
}
?>
</div>
</main>
</body>
</html>
<?php
mysqli_close($koneksi);
ob_flush();
?>
