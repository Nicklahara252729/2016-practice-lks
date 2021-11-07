<?php
ob_start();
include"koneksi.php";
if(getenv('HTTP_X_FORWARDED_FOR')){
  $getip = getenv('HTTP_X_FORWARDED_FOR');
}else{
  $getip = getenv('REMOTE_ADDR');
}

$text = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
$lenght = strlen($text);
$hasil ="";
for($i=0;$i<=5;$i++){
  $hasil = trim($hasil).substr($text,mt_rand(0,$lenght),1);
}

if(isset($_GET['id'])){
  $id = strip_tags(trim($_GET['id']));
  $kelas = strip_tags(trim($_GET['kelas']));
  $sql = mysql_query("select * from bantu where idka='$id' and ip='$getip' and kelas='$kelas'");
}
 ?>
 <!doctype html>
 <html>
 <head>
   <title>Pengisian Data </title>
   <link href="style.css" rel="stylesheet">
   <link href="../js/jquery-ui.css" rel="stylesheet">
 </head>
 <body>
   <div class="container pos-center margin-top-20 padding bg-lightgray">
     <div class="penuh text-center bg-biru height-50 line-height-50">
       <p>REGISTRASI PEMESANAN</p>
     </div>
     <form target="_self" enctype="multipart/form-data" name="regis" id="regis" method="post">
     <div class="penuh padding">
       <div class="seperlima float-left ">
         <?php
         $sql2 = mysql_query("select sum(harga) as total from bantu where idka='$id' and ip='$getip' and kelas='$kelas'");
         $rows2 = mysql_fetch_array($sql2);
         $jum = mysql_num_rows($sql);
         if($jum > 0){
             $rows=mysql_fetch_array($sql);
             $datakursi = explode(',',$rows['bangku']);
             $jmlbangku = count($datakursi);
             echo $jmlbangku;
           for($x=0;$x<$jmlbangku;$x++){
             $total = $rows2['total']*$jmlbangku;
          ?>
         <div class="seperempat border-solid float-left margin-right-10 margin-bottom-10">
           <div class="penuh height-30 bor-bottom-solid bg-lightgray font-20 text-center">
             Kursi <?php echo $datakursi[$x]; ?>
           </div>
           <div class="penuha padding margin-top-10">
             <input type="hidden" value="<?php echo $datakursi[$x]; ?>" name="nobangku<?php echo $x; ?>">
             <input type="text" placeholder="Nama Penumpang" required class="sepersembilan height-40" name="kursi<?php echo $x; ?>">
           </div>
         </div>
         <?php
       }
             ?>
           <input type="hidden" name="jumbangku" value="<?php echo $jmlbangku; ?>">
           <?php
     }
          ?>
       </div>
       <div class="seperlima bg-lightgray float-left ">
         <div class="penuh height-40 bor-bottom-dashed text-center line-height-40">
           <p ><h2>IDENTITAS PEMESAN</h2></p>
         </div>
         <div class="penuh padding">
             <div class="penuh">
               <label class="font-calibri">Nama Lengkap :</label><br>
               <input type="text" class="sepersembilan height-40 margin-top-10"  placeholder="Nama Lengkap" name="nama" id="nama" required>
             </div>
             <div class="penuh margin-top-10">
               <label>Nomor Telp :</label><br>
               <input type="text" class="sepersembilan margin-top-10 height-40"  placeholder="telp" name="telp" id="telp" required>
             </div>
             <div class="penuh margin-top-10">
               <label>Tanggal Pemesanan :</label><br>
               <input type="text" class="sepersembilan margin-top-10 height-40" value="<?php echo date('d'.'/'.'m'.'/'.'Y'); ?>" readonly name="tglpesan" id="tglpesan" required>
             </div>
             <div class="penuh margin-top-10">
               <label>Tanggal Berangkat :</label><br>
               <input type="text" class="sepersembilan margin-top-10 height-40" placeholder="YYYY/mm/dd" name="tglberangkat" id="datepicker" required>
             </div>
             <div class="penuh margin-top-10">
               <label>Total :</label><br>
               <input type="text" value="<?php echo $total; ?>" class="sepersembilan margin-top-10 height-40" placeholder="Total" readonly name="total" id="total" required>
             </div>
             <div class="penuh margin-top-10">
               <button type="button" class="cursor-pointer  seperempat border-solid bg-white  height-40 font-15 font-calibri">Kembali</button>
               <button type="submit" class="seperempat btn-pink btn height-40 font-15 font-calibri">Next</button>
             </div>
             
         </div>
       </div>
     </div>
     </form>
     <?php
             if(isset($_POST['nama'])){
               $nama= strip_tags(trim($_POST['nama']));
               $kode = strip_tags(trim($hasil));
               $telp = strip_tags(trim($_POST['telp']));
               $tglpesan = strip_tags(trim($_POST['tglpesan']));
               $tglberangkat = strip_tags(trim($_POST['tglberangkat']));
               $total = strip_tags(trim($_POST['total']));
                 $jumbangku = strip_tags(trim($_POST['jumbangku']));
               $sql3 = mysql_query("insert into pesan set kode='TKA-$kode',nama='$nama',telp='$telp',tglpesan='$tglpesan',tglberangkat='$tglberangkat',idka='$id',kelas='$kelas',harga='$total',status='Tidak Aktif', ip='$getip'");
               if($sql3){
                 for($g=0;$g<$jumbangku;$g++){
                   $kursi = strip_tags(trim($_POST['kursi'.$g]));
                   $nobangku = strip_tags(trim($_POST['nobangku'.$g]));
                   $sql4 = mysql_query("insert into kursi set pemesan='$nama', penumpang='$kursi', nobangku='$nobangku',kode='TKA-$hasil'");
                 }
                 header("location:kode.php");
               }else{
                 echo "error";
               }
             }
             ?>
   </div>
   <script src="../js/external/jquery/jquery.js" type="text/javascript"></script>
   <script src="../js/jquery-ui.js"></script>
   <script >
   $('#datepicker').datepicker({
     inline:true
   });
   </script>
 </body>
 </html>
 <?php
 mysql_close($koneksi);
 ob_flush();
  ?>
