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
 ?>
 <!doctype html>
 <html>
 <head>
   <title>Kode Tiket</title>
   <link href="style.css" rel="stylesheet">
 </head>
 <body>
   <div class="container border-solid margin-top-60 pos-center padding bg-lightgray">
     <div class="seperlima padding pos-center border-solid bg-white">
       <div class="penuh text-center height-40 bor-bottom-dashed line-height-40 font-20 bg-biru">
         <p>Transaksi Sukses</p>
       </div>
       <div class="penuh margin-top-10 text-center">
         <p>Kode Pemesanan Tiket :</p><br>
         <p><h1><?php echo $rows['kode']; ?></h1></p><br>
         <p><a href="tiketinfo.php?kode=<?php echo $rows['kode'];?>"><button type="button" class="btn btn-pink height-50 seperlima font-20">Next Step</button></a></p>
       </div>
     </div>
   </div>
 </body>
 </html>
 <?php
 mysql_close($koneksi);
 ob_flush();
  ?>
