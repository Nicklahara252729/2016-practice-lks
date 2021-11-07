<?php
ob_start();
include"koneksi(3).php";
if(getenv('HTTP_X_FORWARDED_FOR')){
		$ip= getenv('HTTP_X_FORWARDED_FOR');
	}else{
		$ip=getenv('REMOTE_ADDR');
	}
	$sql = mysqli_query($koneksi,"select a.nama_produk, a.harga_produk, a.kategori, a.gambar, b.ip_komputer,b.kode_produk, b.jumlah from produk a inner join keranjang b on a.id_produk=b.kode_produk where ip_komputer='$ip'");
	$jml = mysqli_num_rows($sql);
	

//Script Captcha-----------------------------------------------------
$text="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
$panjangText= strlen($text);
$hasil="";
for($i=0;$i<=5;$i++){
	$hasil = trim($hasil).substr($text,mt_rand(0,$panjangText),1);	
}
//-------------------------------------------------------------------

if(isset($_POST['kode'])){
	$nama = strip_tags(trim($_POST['nama']));
	$kode = strip_tags(trim($_POST['kode']));
	$email = strip_tags(trim($_POST['email']));
	$tgl = strip_tags(trim($_POST['tgl']));
	$alamat = strip_tags(trim($_POST['alamat']));
	$sql_keranjang = mysqli_query($koneksi,"select * from keranjang where ip_komputer='$ip'");
	//$jml_keranjang =mysqli_num_rows($sql_keranjang);
	//echo $jml_keranjang;
	
	while($ambil = mysqli_fetch_array($sql_keranjang)){
		$sql_beli = mysqli_query($koneksi,"insert into pembelian set kode_transaksi='$kode', nama='$nama', email='$email', alamat='$alamat', tgl_pembelian='$tgl', status='dikirim', ip_komputer='$ip', jumlah='$ambil[jumlah]',kode_produk='$ambil[kode_produk]'");
		if($sql_beli){
			$sql_hapuskeranjang = mysqli_query($koneksi,"delete from keranjang where ip_komputer='$ip' and kode_produk='$ambil[kode_produk]'");
		}
	}
	if($sql_beli){
		$isi = "Kepada Yth : $nama<br>
		Pesanan Anda sedang kami proses, sambil menunggu proses Confirmasi Pembayaran.<p>
		Terima Kasih telah berbelanja di website kami.";
		mail($email,"Pembelian Barang",$isi,"WWW.TokoBuku.COM");
		header("location:terimakasih.php");
	}
	
	
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<style>
body{
	background:gray;
	font-size:15p;
	font-family:"calibri";
}
main{
	width:55%;
	height:630px;
	margin:0 auto;
	background:white;
}
isi{
	width:100%;
}
#isi-satu{
	height:200px;
	border-bottom:solid 1px lightgray;
}
#isi-dua{
	height:380px;
}
#isi-dua table{
	width:100%;
	border-collapse:collapse;
}
#isi-dua th{
	height:30px;
	background:#1A69AA;
	color:white;
}
button{
	float:right;
	border:0;
	height:30px;
	width:100px;
	margin-right:10px;
	border-radius:3px;
	color:white;
}
button[type="submit"]{
	background:green;
}
button[type="reset"]{
	background: #E13B3E;
}
</style>
</head>

<body>
<main>
<div class="content">
<form target="_self" method="post" name="pembelian" id="pembelian" enctype="multipart/form-data">
<div class="isi" id="isi-satu">
<table>
<td>Kode Transaksi</td>
<td>:</td>
<td><b><?php echo $hasil;?><input type="hidden" name="kode" id="kode" value="<?php echo $hasil;?>"></b></td>
</tr>
<tr>
<td>Nama Lengkap</td>
<td>:</td>
<td><input type="text" name="nama" id="nama" required></td>
</tr>
<tr>
<td>Email</td>
<td>:</td>
<td><input type="email" name="email" id="email" required></td>
</tr>
<tr>
<td>Tanggal Pembelian</td>
<td>:</td>
<td><input type="text" name="tgl" id="tgl" value="<?php echo date('Y'.'-'.'m'.'-'.'d'); ?>" readonly></td>
</tr>
<tr>
<tr>
<td>Alamat Tujuan</td>
<td>:</td>
<td><textarea name="alamat"></textarea></td>
</tr>
<tr>
</table>
</div>
<div class="isi" id="isi-dua">
<table>
    <tr>
    <th>No</th>
      <th>Nama Produk</th>
      <th>Harga</th>
      <th>Jumlah</th>
      <th>Total</th>
    </tr>
    <?php
				$totalbayar=0;
	if($jml > 0){
		$no=1;
		$total=0;
		$jumlah=mysqli_query($koneksi,"select sum(jumlah) as total from keranjang");
		$rjumlah = mysqli_fetch_array($jumlah);

		while($r=mysqli_fetch_array($sql)){
			$total=($r['harga_produk'] * $r['jumlah']);
			$totalbayar=$totalbayar + $total;
			$totaljumlah= $rjumlah['total'];
			if($no%2==0){
				$warna = "lightgray";
			}else{
				$warna = "white";
			}
	?>
    <tr bgcolor="<?php echo $warna; ?>">
    <td align="center"><?php echo $no; ?></td>
    <td><?php echo $r['nama_produk']; ?></td>
    <td align="right"><?php echo"Rp.".number_format($r['harga_produk'],2,',','.');?></td></td>
    <td align="center"><?php echo $r['jumlah']; ?></td>
    <td align="right"><?php echo"Rp.".number_format($total,2,',','.'); ?></td>
    </tr>
 <?php
 $no++;
		}
	}
 ?>
     <tr>
    <td colspan="3" style="border:solid 1px lightgray;height:40px;" align="center">TOTAL BAYAR</td>
    <td style="border:solid 1px lightgray;" align="center"><b><?php
	$totaljumlah="";
	 echo $totaljumlah; ?></b></td>
    <td style="border:solid 1px lightgray;" align="right"><b><?php echo"Rp".number_format($totalbayar,2,',','.'); ?></b></td>
    </tr>
  </table>
</div>
<button type="submit" name="submit" id="submit">PAID</button>
<button type="reset" name="reset" id="reset">Cancel</button>
</form>
</div>
</main>
</body>
</html>
<?php
mysqli_close($koneksi);
ob_flush();
?>