<?php
ob_start();
include"koneksi.php";
$sql_kategori = mysql_query("select * from kategori order by kategori asc");
if(isset($_GET['sch_cari'])){

	$cari	  = $_GET['sch_cari'];
	if(!isset($_GET['kategori'])){
		$sql	  = mysql_query("select a.isbn,a.judul,a.sinopsis,a.tahun_terbit,b.nama_penerbit,c.nama,a.stok,a.harga,a.gambar,a.kategori from buku a inner join penerbit b on a.kode_penerbit=b.kode_penerbit inner join penulis c on a.kode_penulis=c.kode_penulis where a.judul like '%$cari%'");
	}else{
	$kategori = $_GET['kategori'];
	$sql	  = mysql_query("select a.isbn,a.judul,a.sinopsis,a.tahun_terbit,b.nama_penerbit,c.nama,a.stok,a.harga,a.gambar,a.kategori from buku a inner join penerbit b on a.kode_penerbit=b.kode_penerbit inner join penulis c on a.kode_penulis=c.kode_penulis where a.judul like '%$cari%' and a.kategori='$kategori'");
	}
}else{
	$sql	= mysql_query("select a.isbn,a.judul,a.sinopsis,a.tahun_terbit,b.nama_penerbit,c.nama,a.stok,a.harga,a.gambar,a.kategori from buku a inner join penerbit b on a.kode_penerbit=b.kode_penerbit inner join penulis c on a.kode_penulis=c.kode_penulis order by judul asc");	
}
$jml	= mysql_num_rows($sql);
$no		=1;
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
    border-collapse: collapse;
    border-spacing: 0;
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
.header select{
	width:150px;
	height:30px;
	border:solid 1px lightgray;
}
</style>
</head>

<body>
<main>
<div class="header">
<button type="button" onClick="location.href='input_buku.php'">+ Tambah</button>
<form id="cari" name="cari" enctype="multipart/form-data" method="get" target="_self">
<select name="kategori">
<option disabled selected>- Pilih Kategori -</option>
<?php
while($data_kategori = mysql_fetch_assoc($sql_kategori)){
	?>
    <option value="<?php echo $data_kategori['kategori'];?>"><?php echo $data_kategori['kategori']; ?></option>
    <?php
}
?>
</select>
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
<td align="center"><a href="edit_buku.php?isbn=<?php echo $r['isbn']; ?>">EDIT</a> | <a href="hapus_buku.php?isbn=<?php echo $r['isbn']; ?>" onClick="return confirm('Anda yakin akan menghapus data  ini ?');">HAPUS</a> | <a href="cetak_buku.php?isbn=<?php echo $r['isbn']; ?>">CETAK</a></td>
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
