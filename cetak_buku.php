<?php
ob_start();
include"koneksi.php";
include"valid-page-user.php";
if(isset($_GET['isbn'])){
	$kode	= strip_tags(trim($_GET['isbn']));
	$sql	= mysql_query("select * from buku where isbn='$kode'");
	$data	= mysql_fetch_array($sql);
	$jml	= mysql_num_rows($sql);
	if($jml <=0){
		?>
        <script>alert('Data tidak ditemukan'); history.back();</script>
        <?php
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Cetak Buku</title>
<style>
body{
	background:#f8f8f8;
}
main{
	width:40%;
	height:150px;
	background:white;
	margin:0 auto;
}
#img{
	width:30%;
	height:150px;
}
#data{
	width:70%;
	padding-left:10px;
}
#img img{
	width:100%;
	height:100%;
}
.judul{
	text-align:center;
	font-weight:bold;
}
#data a, #data strong{
	float:right;
	text-decoration:none;
	color:maroon;
	padding-right:10px;
	cursor:pointer;
}
@media only print {
	#data a,#data strong{
		visibility:hidden;
	}
}
</style>
</head>

<body>
<main>
<table>
<tr>
<td id="img">
<img src="img/<?php echo $data['gambar']; ?>">
</td>
<td id="data">
<b>INFORMASI BUKU</b><br>ISBN : <?php echo $data['isbn']; ?> <br>Judul Buku : <b><?php echo $data['judul']; ?></b><br>Penulis : <?php echo $data['kode_penulis']; ?><br>
Penerbit : <?php echo $data['kode_penerbit']; ?><br>
Kategori : <?php echo $data['kategori']; ?><br>
Harga : <?php echo $data['harga']; ?>
<a href="" onClick="window.print(); ">PRINT</a>
<strong onClick="history.back();">BACK</strong> 
</td>
</tr>
</table>
</main>
</body>
</html>
<?php
mysql_close();
ob_flush();
?>