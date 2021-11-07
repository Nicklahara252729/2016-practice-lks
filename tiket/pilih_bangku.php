<?php
ob_start();
include"koneksi.php";
if(getenv('HTTP_X_FORWARDED_FOR')){
  $getip = getenv('HTTP_X_FORWARDED_FOR');
}else{
  $getip = getenv('REMOTE_ADDR');
}
if(isset($_GET['id'])){
  $id= strip_tags(trim($_GET['id']));
  $harga = strip_tags(trim($_GET['harga']));
  $kelas = strip_tags(trim($_GET['kelas']));
  $sql = mysql_query("select * from kereta where idka='$id'");
  $rows1 = mysql_fetch_array($sql);
}
if(isset($_POST['idka'])){
  $idka = strip_tags(trim($_POST['idka']));
  $harga1 = strip_tags(trim($_POST['harga']));
  $kelas1 = strip_tags(trim($_POST['kelas']));
  $jmlkursi = strip_tags(trim($_POST['jmlkursi']));
    //echo $jmlkursi;
    $bangku = '';
    for($n=1;$n<=$jmlkursi;$n++){
        if(isset($_POST['bangku'.$n])){
            $bangku = $bangku.strip_tags(trim($_POST['bangku'.$n])).','; 
            //echo $n.'<br>';
            //echo $_POST['bangku'.$n].'<br>';
        }
    }
    //echo $bangku;
  $panjang = strlen($bangku);    
  $bangku = substr($bangku, 0, $panjang-1);    
  $sqlin = mysql_query("insert into bantu set ip='$getip', idka='$idka', kelas='$kelas1', harga='$harga1', bangku='$bangku'");
  if($sqlin){
  header("location:indentitas.php?id=$idka&kelas=$kelas1&bangku=$bangku");
  }

}
 ?>
 <!doctype html>
 <html>
 <head>
   <title>Pilih Bangku</title>
   <link href="style.css" rel="stylesheet">
 </head>
 <body >
   <div class="container border-solid padding pos-center margin-top-60 bg-white">
     <div class="penuh bg-biru padding-top-10 padding-bottom-10 text-center margin-bottom-10 ">
       <p class="font-20 font-calibri">PEMILIHAN KURSI</p>
     </div>
     <div class="penuh height-200 bor-top-dashed padding-top-10">
       <form target="_self" enctype="multipart/form-data" name="bangku" id="bangku" method="post">
           <input type="hidden" name="jmlkursi" value="40">
       <?php
           
       for($i=1;$i<=40;$i++){
        
           $nmbangku = "A".$i;
           $sql3 = mysql_query("select * from pesan join kursi on (pesan.kode=kursi.kode) where pesan.idka='$id' and pesan.kelas='$kelas' and kursi.nobangku='$nmbangku'");
           $jumdata = mysql_num_rows($sql3);
           
           if($jumdata > 0){
               $status = "disabled";
               $sold = "SOLD";
               $back = "bg-orange";
           }else{
               $status ="";
               $sold ="";
               $back="";
           }
        //echo $status;
        ?>   
           
       <div class="check sembilanpersen margin-bot height-50  margin-right-10 float-left ">
         <input type="checkbox" id="A<?php echo $i; ?>" name="bangku<?php echo $i; ?>" value="A<?php echo $i; ?>" <?php echo $status; ?>>
         <label for="A<?php echo $i; ?>" class="check-label border-solid <?php echo $back; ?> line-height-50 pos-absolute height-50">A<?php echo $i; echo "&nbsp;<b>".$sold."</b>"; ?></label>
       </div>
       <?php
     }
        ?>
     </div>
     <div class="penuh bor-top-dashed height-100">
       <div class="sepertiga  padding-top-10 float-left">
         <?php
         $sql2 = mysql_query("select * from kursi join pesan on (kursi.kode=pesan.kode) where pesan.idka='$id' and pesan.kelas='$kelas'");
         $jum2 = mysql_num_rows($sql2);
         $sisa = 40 - $jum2;
          ?>
         <div  class="seperempat line-height-40 bg-orange text-center height-40 margin-right-10 font-15 float-left font-calibri">Tersedia <?php echo $sisa; ?></div>
         <div  class="seperempat line-height-40 bg-hijau text-center height-40 font-15 float-left font-calibri">Dipesan <?php echo $jum2; ?></div>
       </div>
       <div class="sepertiga padding float-left bor-right-dashed bor-left-dashed">
<p>
           Nama KA <b><?php echo $rows1['namaka']; ?></b> <br>
           Jurusan <b><?php echo $rows1['jurusan']; ?></b><br>
           Kelas <b><?php echo $kelas ?></b><br>
           Harga Tiket <b>Rp <?php echo number_format($harga,0,',','.'); ?></b><br>
           Waktu Keberangkatan <b><?php echo $rows1['berangkat']; ?></b><br>
           Waktu Tiba <b><?php echo $rows1['tiba']; ?></b><br>
</p>
       </div>
       <div class="sepertiga padding-top-10 float-left ">
         <input type="hidden" name="idka" id="idka" value="<?php echo $id; ?>">
         <input type="hidden" name="harga" id="harga" value="<?php echo $harga; ?>">
         <input type="hidden" name="kelas" id="kelas" value="<?php echo $kelas; ?>">
         <a href="pilih_kereta.php?id=<?php echo $id ?>"><button type="button" class="cursor-pointer margin-left-50 seperempat border-solid bg-white  height-40 font-15 font-calibri">Kembali</button></a>
         <button type="submit" class="seperempat btn-pink btn height-40 font-15 font-calibri">Next</button>
       </div>
     </div>
   </form>
   </div>
   <body>
 </html>
 <?php
 mysql_close($koneksi);
 ob_flush();
  ?>
