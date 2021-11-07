<?php
include"koneksi.php";
if(isset($_POST['kode_tarif'])){
    $kode_tarif = strip_tags(trim($_POST['kode_tarif']));
    $asal = strip_tags(trim($_POST['asal']));
    $tujuan = strip_tags(trim($_POST['tujuan']));
    $berangkat = $_POST['jamb']." : ".$_POST['menitb'];
    $tiba = $_POST['jamt']." : ".$_POST['menitt'];
    $discount = strip_tags(trim($_POST['discount']));
    $status = strip_tags(trim($_POST['status']));
    $jml_tiket = strip_tags(trim($_POST['jml_tiket']));
    $kode_kereta = strip_tags(trim($_POST['kode_kereta']));
    $t_dewasa = strip_tags(trim($_POST['tarif_dewasa']));
    $t_anak = strip_tags(trim($_POST['tarif_anak']));
    $sql = mysql_query("select * from tarif where kode_tarif='$kode_tarif'");
    $jml = mysql_num_rows($sql);
    if($jml > 0){
        ?>
<script>alert('Trif dengan kode <?php echo $kode_tarif; ?> sudah ada');history.back();</script>
<?php
    }else{
            $simpan = mysql_query("insert into tarif set kode_tarif='$kode_tarif', asal='$asal', tujuan='$tujuan',berangkat='$berangkat', tiba='$tiba', diskon='$discount',status='$status', jumlah_tiket='$jml_tiket',kode_kereta='$kode_kereta',tarif_dewasa='$t_dewasa',tarif_anak='$t_anak'");
        }
    }
?>
<!doctype html>
<html>
    <head>
        <title>Train Ticket O</title>
        <link href="default.css" rel="stylesheet">
        <script type="text/javascript">
            function cekfile(){
                var filein =document.getElementById('file');
                var info = filein.files[0];
                var size = info.size;
                var mbsize = Math.round(size / 1048576);
                var kbsize = Math.round(size / 1024);
                if(size  > 2097152){
                    document.getElementById('msgfile').style.color="red";
                    document.getElementById('msgfile').innerHTML="Ukuran foto terlalu besar : "+(mbsize)+" Mb".
                    document.getElementById('msgfile').focus();
                    return false;
                }else{
                    document.getElementById('msgfile').style.color="blue";
                    document.getElementById('msgfile').innerHTML =" Foto size accepted : "+(kbsize)+" kb";
                }
            }
        </script>
    </head>
    <body>
        <main>
            <div class="content" id="content-atas">
                <p>+ Add New Tarif</p>
            </div>
            <div class="content" id="content-bawah">
                <form target="_self" name="tarif" id="tarif" enctype="multipart/form-data" method="post">
                    <input type="text" name="kode_tarif" id="kode_tarif" placeholder="Kode Tarif (T-001)" required>
                    <input type="text" name="asal" id="asa" placeholder="Asal" required>  
                    <input type="text" name="tujuan" id="tujuan" placeholder="Tujuan" required>
                    <label for="berangkat">Jam Keberangkatan : </label><br>
                    <select name="jamb" id="jamb" required>
                        <option selected disabled>- Pilih Jam -</option>
                        <?php
                        for($i=01;$i<=24;$i++){
                            ?>
                        <option value="<?php echo $i; ?>"><?php  echo $i; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <select name="menitb" id="menitb" required>
                        <option selected disabled>- Menit -</option>
                        <?php
                        for ($a=00;$a<=60;$a++){
                            ?>
                        <option value="<?php echo $a; ?>"><?php echo $a; ?></option>
                        <?php
                        }
                        ?>
                    </select><br>
                    <label for="tiba">Tiba ditujuan :</label><br>
                    <select name="jamt" id="jamt" required>
                        <option selected disabled>- Pilih Jam -</option>
                        <?php
                        for($i=01;$i<=24;$i++){
                            ?>
                        <option value="<?php echo $i; ?>"><?php  echo $i; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <select name="menitt" id="menitt" required>
                        <option selected disabled>- Menit -</option>
                        <?php
                        for ($a=00;$a<=60;$a++){
                            ?>
                        <option value="<?php echo $a; ?>"><?php echo $a; ?></option>
                        <?php
                        }
                        ?>
                    </select><br>
                    <input type="number" placeholder="Discount" name="discount" id="discount" required>
                    <input type="text" name="status" id="status" placeholder="Status" required>
                    <input type="number" name="jml_tiket" id="jml_tiket"  placeholder="Jumlah Tiket" required>
                    <label for="kodekereta">Pilih Kode Kereta :</label><br>
                    <select name="kode_kereta" id="kode_kereta" class="kodeka"> 
                        <option selected disabled>- Pilih Kode -</option>
                        <?php
                        $kereta_sql = mysql_query("select * from kereta order by kode_kereta asc");
                        while($rkereta = mysql_fetch_assoc($kereta_sql)){
                            ?>
                        <option value="<?php echo $rkereta['kode_kereta']; ?>">
                            <?php echo $rkereta['kode_kereta']; ?>
                        </option>
                        <?php
                        }
                        ?>
                    </select><br>
                    <input type="text" name="tarif_dewasa" id="tarif_dewasa" placeholder="Tarif Dewasa" required>
                    <input type="text" name="tarif_anak" id="tarif_anak" placeholder="Tarif Anak" required>
                    <button type="submit">Simpan</button>
                    <button type="reset">Resset Data</button>
                </form>
            </div>
        </main>
    </body>
</html>