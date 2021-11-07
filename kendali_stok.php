<?php
ob_start();
include"koneksi.php";
if(isset($_GET['sch_kendali'])){
	$sch_kendali	= $_GET['sch_kendali'];
	$sql		= mysql_query("select * from buku where isbn like '%$sch_kendali%' or judul like '%$sch_kendali%' order by judul asc");
	$jml	= mysql_num_rows($sql);
}else{
	$sql		= mysql_query("select * from buku order by judul asc");
	$jml		= 0;
}

$no		=1;
if(isset($_POST['isbn'])){
	$isbn		= strip_tags(trim($_POST['isbn']));
	//$stok_lama	= strip_tags(trim($_POST['stok']));
	$stok_baru	= strip_tags(trim($_POST['add_stok']));
	$sql_addstok = mysql_query("update buku set stok=(stok+'$stok_baru') where isbn='$isbn'");
	header("location:kendali_stok.php");
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Kendali Stok</title>
<style>
header,main{
	width:40%;
	border-bottom:solid 1px lightgray;
	border-right:solid 1px lightgray;
	border-left:solid 1px lightgray;
	margin:0 auto;
	font-family:"calibri";
	font-size:15px;
}
header{
	height:50px;
	border-top:solid 1px lightgray;
	text-align:center;
}
header form{
	margin-top:10px;
}
header input{
	width:200px;
	height:30px;
	border:solid 1px lightgray;
	background:#f8f8f8;
	padding-left:10px;
}
main{
	height:auto;
	padding-top:10px;
	padding-bottom:10px;
}
.isi-tampil{
	float:left;

}
#left{
	background:yellow;
	width:30%;
}
main table{
	width:100%;
}
.img{
	width:25%;
	height:130px;
}
.data{
	height:100px;
}
.img img{
	height:100%;
	width:100%;
}
.data2{
	height:30px;
}
.data2 input{
	border:solid 1px lightgray;
	height:20px;
}
.data2 button{
	border:0;
	height:24px;
	color:white;
	background:green;
}
</style>
</head>

<body>
<header>
<form method="get" id="kendali_sch" name="kendali_sch" enctype="multipart/form-data" target="_self">
<input type="search" name="sch_kendali" name="sch_kendali" placeholder="Cari Isbn / Judul Buku" onKeyUp="this.submit();" autofocus>
</form>
</header>
<main>
<div class="tampil">
<?php if($jml > 0){  ?>
<table>
<?php 
while($r=mysql_fetch_array($sql)){ ?>
<tr>
<td rowspan="2" class="img">
<img src="img/<?php echo $r['gambar']; ?>" height="100px" width="100px">
</td>
<td class="data">
<b>DATA BUKU</b><br>

<b>ISBN :</b> <?php echo $r['isbn']; ?> <br>
<b>Judul Buku :</b> <?php echo $r['judul']; ?> <br>
<b>Sinopsis : </b><?php echo $r['sinopsis']; ?> <br>
<b>Tahun Terbit :</b> <?php echo $r['tahun_terbit']; ?> <br>
<td class="data">
<b>Penulis : </b><?php echo $r['kode_penulis']; ?> <br>
<b>Penerbit : </b><?php echo $r['kode_penerbit']; ?> <br> 
<b>Stok : </b><?php echo $r['stok']; ?> <br>
<b>Harga : </b><?php echo $r['harga']; ?> <br> 
<b>Kategori :</b> <?php echo $r['kategori']; ?>
<tr>
  <td height="10" colspan="2" class="data2">
  <form target="_self" method="post" name="add_stok" id="add_stok" enctype="multipart/form-data">
  <input type="hidden" name="isbn" id="isbn" value="<?php echo $r['isbn']; ?>">
  <!--<input type="hidden" name="stok" id="stok" value="<?php //echo $r['stok']; ?>">-->
    Stok :  <input type="text" name="add_stok" id="add_stok" onKeyUp="this.submit();">
    <button type="submit" name="submit" id="submit">+ Tambah</button>
    </form>
    </td>
  </tr>
</table>
<?php 
$no++;
} ?>
<?php }else{ echo"Not Found";} ?>
</div>
</main>
</body>
</html>
<?php
mysql_close($koneksi);
ob_flush();
?>