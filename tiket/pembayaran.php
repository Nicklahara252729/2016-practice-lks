<?php
ob_start();
include"koneksi.php";
if(getenv('HTTTP_X_FORWARDED_FOR')){
  $getip = getenv('HTTP_X_FORWARDED_FOR');
}else{
  $getip = getenv('REMOTE_ADDR');
}

if(isset($_POST['kode'])){
  $kode = strip_tags(trim($_POST['kode']));
  $via = strip_tags(trim($_POST['bank']));
  $jumlah = strip_tags(trim($_POST['jumlah']));
  $pengirim = strip_tags(trim($_POST['pengirim']));
  $cek = mysql_query("select * from pesan where ip='$getip' and kode='$kode'");
  $jum = mysql_num_rows($cek);
  if($jum > 0){
    $sql2 = mysql_query("insert into transaksi set kode='$kode', ip='$getip', via='$via', jumlah='$jumlah', pengirim='$pengirim'");
    if($sql2){
    $sql3 = mysql_query("update pesan set status='Aktif' where ip='$getip' and kode='$kode'");
    $sql4 = mysql_query("delete from bantu");
      header("location:pesan.php?kode=$kode");
    }else{
      ?>
      <script>alert('gagal');.history.back();</script>
      <?php
    }
  }
}
 ?>
 <!doctype html>
 <html>
 <head>
   <title>Konfirmasi Pembayaran</title>
   <link href="style.css" rel="stylesheet">
 </head>
 <body>
   <div class="container margin-top-60 border-solid pos-center padding bg-lightgray">
     <div class="sepertiga border-solid pos-center padding bg-white">
       <div class="penuh text-center bg-biru height-40 line-height-40">
         <p>Konfirmasi Pembayaran </p>
       </div>
       <form target="_self" enctype="multipart/form-data" method="post" name="pembayaran" id="pembayaran">
       <div class="penuh bor-top-dashed margin-top-10 padding-top-10">
         <label class="font-17">Kode :</label>
         <input type="text" class="sepersembilan height-40 margin-top-10" name="kode" id="kode" placeholder="Kode Pemesanan" required>
       </div>
       <div class="penuh margin-top-10 padding-top-10">
         <label class="font-17">Via :</label>
         <select class="penuh height-40 margin-top-10" required name="bank" id="bank">
           <option selected disabled>- Pilih Pengiriman -</option>
           <option value="BNI">BNI</option>
           <option value="BRI">BRI</option>
           <option value="Mandiri">Mandiri</option>
         </select>
       </div>
       <div class="penuh  margin-top-10 padding-top-10">
         <label class="font-17">Jumlah :</label>
         <input type="text" class="sepersembilan height-40 margin-top-10" name="jumlah" id="jumlah" placeholder="Jumlah" required>
       </div>
       <div class="penuh margin-top-10 padding-top-10">
         <label class="font-17">Pengirim :</label>
         <input type="text" class="sepersembilan height-40 margin-top-10" name="pengirim" id="pengirim" placeholder="Pengirim" required>
       </div>
       <div class="penuh margin-top-10 padding-top-10">
         <button type="button" class="cursor-pointer  seperempat border-solid bg-white  height-40 font-15 font-calibri">Kembali</button>
         <button type="submit" class="seperlima btn-pink btn height-40 font-15 font-calibri">Next</button>
       </div>
     </form>
     </div>
   </div>
 </body>
 </html>
 <?php
 mysql_close($koneksi);
 ob_flush();
  ?>
