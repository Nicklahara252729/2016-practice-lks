<?php
ob_start();
include"koneksi.php";
include"valid-page-user.php";
if(isset($_GET['kode_penerbit'])){
	$kode	= strip_tags(trim($_GET['kode_penerbit']));
	$sql	= mysql_query("select * from penerbit where kode_penerbit='$kode'");
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
<title>Tampil User</title>
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
#data a{
	float:right;
	text-decoration:none;
	color:maroon;
	padding-right:10px;
}
@media only print {
	#data a{
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
<img src="img/<?php echo $data['photo']; ?>">
</td>
<td id="data">
<p><b>DATA PENERBIT</b><br>Kode Penerbit : <?php echo $data['kode_penerbit']; ?> <br>Nama Penerbit : <b><?php echo $data['nama_penerbit']; ?></b><br>Alamat : <?php echo $data['alamat']; ?><br>
Email : <?php echo $data['email']; ?><br>
Telepon : <?php echo $data['telp']; ?>
<a href="" onClick="window.print(); ">PRINT</a>
</p>
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