<?php
ob_start();
include "koneksi.php";
if(isset($_GET['sch_cari'])){
	$cari	= $_GET['sch_cari'];
	$sql	= mysql_query("select * from penulis where nama like '%$cari%' or kode_penulis like '%$cari%' or alamat like '%$cari%' order by nama asc");
}else{
	$sql	= mysql_query("select * from penulis order by nama asc");
}
$jml	= mysql_num_rows($sql);
$no		= 1;

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tampil Penulis</title>
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
</style>
</head>

<body>
<main>
<div class="header">
<button type="button" onClick="location.href='input_penulis.php?hal=tampil';">+ Tambah</button>
<form id="cari" name="cari" enctype="multipart/form-data" method="get" target="_self">
<input type="search" name="sch_cari" id="sch_cari" placeholder="Search" onKeyUp="this.submit();">
</form>
</div>
<table>
<tr class="tr-satu">
<th>No</th>
<th>Kode Penulis</th>
<th>Nama</th>
<th>Alamat</th>
<th>Jenis Kelamin</th>
<th>No Telp</th>
<th>Email</th>
<th>Photo</th>
<th>Action</th>
</tr>
<?php
while($data_penulis=mysql_fetch_array($sql)){
	if($no%2==0){
		$warna	= "lightgray";
	}else{
		$warna	= "white";
	}
?>
<tr class="tr-data" bgcolor="<?php echo $warna; ?>">
<td align="center"><?php echo $no; ?></td>
<td><?php echo $data_penulis['kode_penulis']; ?></td>
<td><?php echo $data_penulis['nama']; ?></td>
<td><?php echo $data_penulis['alamat']; ?></td>
<td align="center"><?php echo $data_penulis['sex']; ?></td>
<td><?php echo $data_penulis['telp']; ?></td>
<td><?php echo $data_penulis['email']; ?></td>
<td><img src="img/<?php echo $data_penulis['photo']; ?>" class="foto"></td>
<td align="center"><a href="edit_penulis.php?kode_penulis=<?php  echo $data_penulis['kode_penulis'];?>">EDIT</a> | <a href="hapus_penulis.php?kode_penulis=<?php echo $data_penulis['kode_penulis']; ?>" onClick="return confirm('Anda yakin akan menghapus data <?php echo $data_penulis['nama'];  ?> ini ?');">HAPUS</a> | <a href="cetak_penulis.php?kode_penulis=<?php echo $data_penulis['kode_penulis']; ?>">CETAK</a></td>
</tr>
<?php
$no++;
}
?>
</table>
Jumlah Data : <?php echo $jml; ?> Record.
</main>
</body>
</html>
<?php
mysql_close($koneksi);
ob_flush();
?>