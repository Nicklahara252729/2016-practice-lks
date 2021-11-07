<?php
ob_start();
include"koneksi.php";
if(getenv('HTTP_X_FORWARDED_FOR')){
		$ip= getenv('HTTP_X_FORWARDED_FOR');
	}else{
		$ip=getenv('REMOTE_ADDR');
	}
	$sql_lihat_keranjang = mysqli_query($koneksi,"select a.nama_produk, a.harga_produk, a.kategori, a.gambar, b.ip_komputer,b.kode_produk, b.jumlah from produk a inner join keranjang b on a.id_produk=b.kode_produk where ip_komputer='$ip'");
	
if(isset($_GET['id'])){
	$kode_produk= $_GET['id'];
	$sql_hapus = mysqli_query($koneksi,"delete from keranjang where kode_produk='$kode_produk' and ip_komputer='$ip'");
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<style>
main{
	width:80%;
	height:auto;
	border:solid 1px lightgray;
	margin: 0 auto;
}
main table{
	width:100%;
}
main th{
	background:#1663A3;
	color:white;
}
</style>
</head>

<body>
<main>
  <table>
    <tr>
    <th>No</th>
      <th>Nama Produk</th>
      <th>Harga</th>
      <th>Kategori</th>
      <th>Gambar</th>
      <th>Jumlah</th>
      <th>Total</th>
      <th>Action</th>
    </tr>
    <?php
			$no=1;
			$total=0;
			$totalbayar=0;
	while($lihat= mysqli_fetch_array($sql_lihat_keranjang)){
		$total=($lihat['harga_produk'] * $lihat['jumlah']);
		$totalbayar=$totalbayar + $total;
	?>
	<tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $lihat['nama_produk']; ?></td>
    <td><?php echo $lihat['harga_produk']; ?></td>
    <td><?php echo $lihat['kategori']; ?></td>
    <td align="center"><img src="img/<?php echo $lihat['gambar']; ?>" width="70px" height="70px"></td>
    <td align="center"><?php echo $lihat['jumlah']; ?></td>
    <td><?php echo "Rp.".number_format($total,2,',','.'); ?></td>
    <td align="center"><a href="keranjang.php?id=<?php echo $lihat['kode_produk']; ?>">HAPUS</a> | <a href="update_keranjang.php?idupdate=<?php echo $lihat['kode_produk']; ?>">UPDATE</a></td>
    </tr>
   
    <?php
	 $no++;
	}
	?>
     <tr>
    <td colspan="6">TOTAL BAYAR</td>
    <td><?php echo"Rp.".number_format($totalbayar,2,',','.'); ?></td>
    </tr>
  </table>
</main>
</body>
</html>
<?php
mysqli_close($koneksi);
ob_flush();
?>