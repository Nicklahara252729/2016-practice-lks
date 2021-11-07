<?php
ob_start();
include"koneksi.php";
if(getenv('HTTP_X_FORWARDED_FOR')){
  $getip = getenv('HTTP_X_FORWARDED_FOR');
}else{
  $getip = getenv('REMOTE_ADDR');
}
if(isset($_GET['kode'])){
  $kode = strip_tags(trim($_GET['kode']));
$sql = mysql_query("select * from pesan join kereta on (pesan.idka=kereta.idka) where ip='$getip' and kode='$kode'");
}

 ?>
 <!doctype html>
 <html>
 <head>
   <title>Informasi Tiket</title>
   <link href="style.css" rel="stylesheet">
 </head>
 <body>
   <div class="container padding bg-lightgray pos-center margin-top-60">
     <div class="penuh height-40 bg-white bor-bottom-dashed text-center line-height-40">
       <p><h2>Informasi Tiket Anda</h2></p>
     </div>
     <div class="penuh margin-top-10">
       <table>
         <tr>
           <th>No</th>
           <th>jurusan</th>
           <th>Berangkat</th>
           <th>Jam</th>
           <th>Status</th>
           <th>Print</th>
         </tr>
         <?php
         $jum = mysql_num_rows($sql);
         if($jum > 0){
           $no =1;
           while ($rows = mysql_fetch_array($sql)){
          ?>
         <tr>
           <td class="padding text-center"><?php echo $no; ?></td>
           <td class="padding text-center"><?php echo $rows['jurusan'] ?></td>
           <td class="padding text-center"><?php echo $rows['tglberangkat'] ?></td>
           <td class="padding text-center"><?php echo $rows['berangkat'] ?></td>
           <td class="padding text-center"><?php echo $rows['status'] ?></td>
           <td class="padding text-center"><button type="button" class="btn height-35 seperlima bg-orange">Print</button></td>
         </tr>
         <?php
       }
     }else{
       echo "no data found";
     }
          ?>
       </table>
     </div>
     <div class="penuh padding">
       <?php
       $sql3 = mysql_query("select * from pesan where  ip='$getip' and kode='$kode'");
       $jum3 = mysql_num_rows($sql3);
       if($jum3 > 0){
         $rows3 = mysql_fetch_array($sql3);
         if($rows3['status']=="Tidak Aktif"){
           ?>
           <a href="pembayaran.php"><button type="buttton" class="btn height-40 sepertiga bg-biru">Konfirmasi Pembayaran</button></a>
           <?php
         }else{
           ?>
           <button type="buttton" class="btn border-solid height-40 sepertiga bg-white">Konfirmasi Pembayaran</button>
           <?php
         }
       }
        ?>

     </div>
   </div>
 </body>
 </html>
 <?php
 mysql_close($koneksi);
 ob_flush();
  ?>
