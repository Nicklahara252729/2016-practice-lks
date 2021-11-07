<?php
ob_start();
include"koneksi.php";
if(isset($_GET['id'])){
  $id = strip_tags(trim($_GET['id']));
  $sql = mysql_query("select * from kereta where idka='$id'");
}
if(isset($_POST['idka'])){
  $idka = strip_tags(trim($_POST['idka']));
  $harga = strip_tags(trim($_POST['harga']));
  $kelas = strip_tags(trim($_POST['kelas']));
  header("location:pilih_bangku.php?id=$idka&harga=$harga");
}
?>
<!doctype html>
<html>
<head>
  <title>Pilih Kereta</title>
  <link href="style.css" rel="stylesheet">
</head>
<body class="bg-lightgray">
  <div class="container padding border-solid bg-white pos-center margin-top-50" >
    <div class="penuh  padding-top-10 padding-bottom-10 text-center font-19 bor-bottom-dashed">
      Pemilihan Kereta
    </div>
    <div class="penuh  margin-top-10">
      <table class="font-calibri ">
        <tr>
          <th class="bor-right-dashed">No</th>
          <th class="bor-right-dashed">Nama KA</th>
          <th class="bor-right-dashed">Berangkat</th>
          <th class="bor-right-dashed">Tiba</th>
          <th class="bor-right-dashed">Jurusan</th>
          <th class="bor-right-dashed" colspan="2">Harga</ht>
          <th >Action</th>
        </tr>
        <form target="_self" enctype="multipart/form-data" method="post" name="pilih" id="pilih">
          <?php
          $jum= mysql_num_rows($sql);
          if($jum > 0){
            $no = 1;
            while ($rows = mysql_fetch_array($sql)){
           ?>
        <tr>
          <td class="padding bor-right-dashed bor-left-dashed text-center"><?php echo $no; ?></td>
          <td class="padding bor-right-dashed"><?php echo $rows['namaka']; ?></td>
          <td class="padding bor-right-dashed text-center"><?php echo $rows['berangkat']; ?></td>
          <td class="padding bor-right-dashed text-center"><?php echo $rows['tiba']; ?></td>
          <td class="padding bor-right-dashed text-center"><?php echo $rows['jurusan']; ?></td>
          <td class="padding bor-right-dashed">Eksekutif<br>Rp <?php echo number_format($rows['eksekutif'],0,',','.'); ?>
            <div class="check penuh margin-top-10 margin-bottom-10" >
              <input name="harga" type="checkbox" id="A1" value="<?php echo $rows['eksekutif']; ?>&kelas=eksekutif">
              <label class="check-label pos-absolute height-30 border-solid" for="A1">Pilih</lable>
                <input name="kelas" type="hidden" value="eksekutif" id="A1">
            </div>
          </td>
          <td class="padding bor-right-dashed">Ekonomi<br>Rp  <?php echo number_format($rows['ekonomi'],0,',','.'); ?>
            <div class="check penuh margin-top-10 margin-bottom-10" >
              <input name="harga" type="checkbox" id="A2" value="<?php echo $rows['ekonomi']; ?>&kelas=ekonomi">
              <label class="check-label pos-absolute height-30 border-solid" for="A2">Pilih</lable>
                <input name="kelas" type="hidden" value="ekonomi" id="A2">
            </div>
          </td>
          <td class="padding bor-right-dashed">
            <input type="hidden" name="idka" value="<?php echo $rows['idka']; ?>">
            <button type="submit" class="penuh btn btn-biru height-35">Next</button>
          </td>
        </tr>
        <?php
        $no++;
      }
    }else{
      ?>
      <tr>
        <td colspan="8" class="text-center height-40">Data Not Found</td>
      </tr>
      <?php
    }
         ?>
      </form>
      </table>
    </div>
    <div>
  </div>
</body>
</html>
<?php
mysql_close($koneksi);
ob_flush();
?>
