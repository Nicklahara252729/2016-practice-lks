<?php
ob_start();
include"koneksi.php";
if(isset($_GET['sch_cari'])){
	$cari	= $_GET['sch_cari'];
	$sql	= mysql_query("select a.isbn,a.judul,a.sinopsis,a.tahun_terbit,b.nama_penerbit,c.nama,a.stok,a.harga,a.gambar,a.kategori from buku a inner join penerbit b on a.kode_penerbit=b.kode_penerbit inner join penulis c on a.kode_penulis=c.kode_penulis where a.judul like '%$cari%'");
}else{
	$sql	= mysql_query("select a.isbn,a.judul,a.sinopsis,a.tahun_terbit,b.nama_penerbit,c.nama,a.stok,a.harga,a.gambar,a.kategori from buku a inner join penerbit b on a.kode_penerbit=b.kode_penerbit inner join penulis c on a.kode_penulis=c.kode_penulis order by judul asc");	
}
$jml	= mysql_num_rows($sql);
$no		=1;
if(getenv('HTTP_X_FORWARDED_FOR')){
		$getip	= getenv('HTTP_X_FORWARDED_FOR');
	}else{
		$getip	= getenv('REMOTE_ADDR');
	}
if(isset($_GET['beli'])){
	$isbn	= $_GET['isbn'];
	
	$sql_cek	= mysql_query("select * from keranjang where isbn='$isbn' and ip_komputer='$getip'");
	$jml_cek	= mysql_num_rows($sql_cek);
	if($jml_cek > 0){
		$sql_keranjang = mysql_query("update keranjang set jumlah=(jumlah+1) where isbn='$isbn' and ip_komputer='$getip'");
	}else{
		$sql_keranjang =  mysql_query("insert into keranjang set ip_komputer='$getip', isbn='$isbn', jumlah='1'");
	}
	header("location:keranjang.php");
}

$sql_cekkeranjang = mysql_query("select sum(jumlah) as 'total' from keranjang where ip_komputer='$getip'");
$data_cekkeranjang = mysql_fetch_array($sql_cekkeranjang);
$jml_cekkeranjang = mysql_num_rows($sql_cekkeranjang);
if($jml_cekkeranjang >0 ){
	$isikeranjang = $data_cekkeranjang['total'];
}else{
	$isikeranjang =0;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tampil Buku</title>
<style>
main{
	width:100%;
	height:auto;
	margin:0 auto;
	border:solid 1px lightgray;
}
.header{
	width:100%;
	border-bottom:solid 1px lightgray;
	height:50px;
}
.header form{
	float:right;
}
.header button[type="button"]{
	border:0;
	height:60%;
	width:100px;
	color:white;	
	background:green;
	margin-left:10px;
	margin-top:10px;
}
.header input[type="search"]{
	width:100px;
	height:30px;
	border:solid 1px lightgray;
	background:#f8f8f8;
	margin-top:10px;
	margin-right:10px;
	padding-left:10px;
	transition:all 1.5s ease-in-out;
}
.header input[type="search"]:focus{
	width:500px;

}
main table{
	width:100%;
}

.tr-satu{
	background:blue;
	height:30px;
	color:white;
}
.tr-data{
	height:35px;
}
.tr-data:hover{
	background-color:green;
	color:white;
	cursor:pointer;
}
.foto{
	width:50px;
	height:50px;
	border-radius:50%;
	transition:all 1s ease-in-out;
}
.foto:hover{
	transform:scale(3,3);
}
.isi-keranjang{
	float:left;
}
</style>
</head>

<body>
<main>
<div class="header">
<button type="button" onClick="location.href='input_buku.php'">+ Tambah</button>
<div class="isi-keranjang">Isi Keranjang : <?php echo $isikeranjang; ?></div>
<form id="cari" name="cari" enctype="multipart/form-data" method="get" target="_self">
<input type="search" name="sch_cari" id="sch_cari" placeholder="Search" onKeyUp="this.submit();">
</form>
</div>
<table>
<tr class="tr-satu">
<th>No</th>
<th>ISBN</th>
<th>Judul</th>
<th>Sinopsis</th>
<th>Tahun Terbit</th>
<th>Nama Penulis</th>
<th>Nama Penerbit</th>
<th>Stok</th>
<th>Harga</th>
<th>Gambar</th>
<th>Kategori</th>
<th>Action</th>
</tr>
<?php
while($r=mysql_fetch_array($sql)){
	if($no%2==0){
		$warna ="lightgray";
	}else{
		$warna ="white";
	}
?>
<tr class="tr-data" bgcolor="<?php echo $warna; ?>" >
<td align="center"><?php echo $no; ?></td>
<td><?php echo $r['isbn']; ?></td>
<td><?php echo $r['judul']; ?></td>
<td><?php echo $r['sinopsis']; ?></td>
<td><?php echo $r['tahun_terbit']; ?></td>
<td><?php echo $r['nama']; ?></td>
<td><?php echo $r['nama_penerbit']; ?></td>
<td align="right"><?php echo $r['stok']; ?></td>
<td align="right"><?php echo $r['harga']; ?></td>
<td><img src="img/<?php echo $r['gambar']; ?>" class="foto"></td>
<td><?php echo $r['kategori']; ?></td>
<td align="center"><a href="keranjang.php?beli=beli&isbn=<?php echo $r['isbn']; ?>">BELI</a></td>
</tr>
<?php
$no++;
}
?>
</table>
Jumlah Data : <?php echo $jml; ?>  Record.

</main>
</body>
</html>
<?php
mysql_close($koneksi);
ob_flush();
?>
