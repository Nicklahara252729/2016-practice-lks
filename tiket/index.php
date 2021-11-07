<?php
ob_start();
include"koneksi.php";
if(isset($_POST['dari'])){
  $jurusan = strip_tags(trim($_POST['dari']))." - ".strip_tags(trim($_POST['ke']));
  $sql = mysql_query("select * from kereta where jurusan='$jurusan'");
  $jum = mysql_num_rows($sql);
  $rows = mysql_fetch_array($sql);
  if($jum > 0){
    header("location:pilih_kereta.php?id=$rows[idka]");
  }
}
 ?>
<!doctype html>
<html>
<head>
<title>Pemesanan Tiket</title>
<link href="style.css" rel="stylesheet">
</head>
<body class="font-calibri bg-lightgray">
  <div class="wrapper padding-top-60">
    <div class="sepertiga pos-center border-solid padding bg-white">
      <div class="penuh height-40 text-center font-20 bor-bottom-dashed margin-bottom-10 padding-top-10">
        <p>Pemesanan Tiket</p>
      </div>
      <form target="_self" method="post" enctype="multipart/form-data" name="tiket"  id="tiket" >
        <div class="penuh margin-bottom-10 ">
          <select name="dari" id='dari' class="height-40 penuh font-15">
            <option disabled selected class="height-30 penuh font-15 padding">- Dari -</option>
            <option value="Medan" class="height-30 penuh font-15 padding">Medan</option>
            <option value="Kisaran" class="height-30 penuh font-15 padding">Kisaran</option>
            <option value="Tebing tinggi" class="height-30 penuh font-15 padding">Tebing Tinggi</option>
          </select>
        </div>
        <div class="penuh margin-bottom-10">
          <select name="ke" id='ke' class="height-40 penuh font-15">
            <option disabled selected class="height-30 penuh font-15 padding">- ke -</option>
            <option value="Medan" class="height-30 penuh font-15 padding">Medan</option>
            <option value="Kisaran" class="height-30 penuh font-15 padding">Kisaran</option>
            <option value="Tebing tinggi" class="height-30 penuh font-15 padding">Tebing Tinggi</option>
          </select>
        </div>
        <div class="penuh">
          <button type="submit" class="btn penuh btn-biru height-40 font-17">Next</button>
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
