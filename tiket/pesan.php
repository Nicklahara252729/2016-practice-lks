<?php
ob_start();
include"koneksi.php";
if(getenv('HTTP_X_FORWARDED_FOR')){
  $getip = getenv('HTTP_X_FORWARDED_FOR');
}else{
  $getip = getenv('REMOTE_ADDR');
}
$tgl = date('d'.'/'.'m'.'/'.'Y');
$sql = mysql_query("select * from pesan where ip='$getip' and tglpesan='$tgl' order by idpesan desc");
$rows = mysql_fetch_array($sql);
if(isset($_GET['kode'])){
    $kode = strip_tags(trim($_GET['kode']));
}
 ?>
 <!doctype html>
 <html>
 <head>
   <title>Transaksi Sukses</title>
   <link href="style.css" rel="stylesheet">
 </head>
 <body class="bg-lightgray">
   <div class="container bg-white margin-top-60 border-solid pos-center padding">
     <div class="padding text-center seperlima pos-center bor-radius-3 bor-bottom-dashed margin-bottom-10">
       <p><h3>Transaksi Berhasil</h3> </p>
     </div>
     <div class="font-15 padding text-center bg-hijau-muda seperlima pos-center bor-radius-3 border-solid-green">
       <p>Pemesana Tiket Anda Telah Dikonfirmasi<br>Silahkan Cetak Tiket Anda<br> Terima Kasih Telah Menggunakan Jasa Kami</p>
       <p class="margin-top-10">
         <a href="cetak_tiket.php?kode=<?php echo $kode; ?>"><button type="button" class="btn sepertiga height-40 bg-orange">Cetak</button></a>
         <a href="tiketinfo.php?kode=<?php echo $rows['kode']; ?>"><button type="button" class="btn sepertiga height-40 bg-biru">Info Tiket</button></a>
       </p>
     </div>
   </div>
 </body>
 </html>
 <?php
 mysql_close($koneksi);
 ob_flush();
  ?>
