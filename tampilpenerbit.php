<?php
ob_start();
include "koneksi.php";
if(isset($_GET['sch_cari'])){
	$cari	= $_GET['sch_cari'];
	$sql	= mysql_query("select * from penerbit where nama_penerbit like '%$cari%' or alamat like '%$cari%' order by nama_penerbit asc");
}else{
	$sql	= mysql_query("select * from penerbit order by nama_penerbit asc");
}
$jml	= mysql_num_rows($sql);
$no		= 1;

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tampil Penerbit</title>
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
<button type="button" onClick="location.href='input_penerbit.php?hal=tampil';">+ Tambah</button>
<form id="cari" name="cari" enctype="multipart/form-data" method="get" target="_self">
<input type="search" name="sch_cari" id="sch_cari" placeholder="Search" onKeyUp="this.submit();">
</form>
</div>
<?php if($jml > 0){ ?>
<table>
<tr class="tr-satu">
<th>No</th>
<th>Kode Penerbit</th>
<th>Nama Penerbit</th>
<th>Alamat</th>
<th>Telepon</th>
<th>Email</th>
<th>Website</th>
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
<td><?php echo $data_penulis['kode_penerbit']; ?></td>
<td><?php echo $data_penulis['nama_penerbit']; ?></td>
<td><?php echo $data_penulis['alamat']; ?></td>
<td align="center"><?php echo $data_penulis['telp']; ?></td>
<td><?php echo $data_penulis['email']; ?></td>
<td><?php echo $data_penulis['website']; ?></td>
<td align="center"><a href="edit_penerbit.php?kode_penerbit=<?php  echo $data_penulis['kode_penerbit'];?>">EDIT</a> | <a href="hapus_penerbit.php?kode_penerbit=<?php echo $data_penulis['kode_penerbit']; ?>" onClick="return confirm('Anda yakin akan menghapus data <?php echo $data_penulis['nama'];  ?> ini ?');">HAPUS</a> | <a href="cetak_penerbit.php?kode_penerbit=<?php echo $data_penulis['kode_penerbit']; ?>">CETAK</a></td>
</tr>
<?php
$no++;
}
?>
</table>
Jumlah Data : <?php echo $jml; ?> Record.
<?php }else{ 
echo "Data yang anda cari : <b>$cari</b> tidak ketemu";}?>
</main>
</body>
</html>
<?php
mysql_close($koneksi);
ob_flush();
?>