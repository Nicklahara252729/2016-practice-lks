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
                <p>PEMESANAN</p>
            </div>
            <div class="content" id="content-bawah">
                <form target="_self" name="pesan" id="pesan" enctype="multipart/form-data" method="post">
                    <label for="kodepesan"><?php
                        $text = "ABCDEFGHIJKLMNOPQRTTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
                        $ptext = strlen($text);
                        $hasil ="";
                        for($i=0;$i<=5;$i++){
                            $hasil=trim($hasil).substr($text,mt_rand(0,$ptext),1);
                        } 
                        echo $hasil;
                        ?></label><br>
                    <input type="hidden" value="<?php echo $hasil; ?>">
                    <label for="tgl">Pilih Tanggal Pemesanan :</label><br>
                    <select name="tgl" id="tgl" required class="tgl">
                        <option selected disabled>- Pilih Tanggal -</option>
                        <?php
                        for($i=1;$i<=31;$i++){
                        ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <select name="bulan" id="bulan" required  class="bln">
                        <option selected disabled>- Pilih Bulan -</option>
                        <?php 
                        for($b=1;$b<=12;$b++){
                            ?>
                        <option value="<?php echo $b; ?>"><?php echo $b; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <select id="tahun" name="tahun" required class="thn">
                        <option disabled selected>- Pilih Tahun -</option>
                        <?php
                        for($t=date('Y');$t<=2019;$t++){
                            ?>
                        <option value="<?php echo $t; ?>"><?php echo $t; ?></option>
                        <?php
                        }
                        ?>
                    </select><br>                    
                    <input type="number" name="jml_dewasa" id="jml_dewasa" placeholder="Jumlah Dewasa" required>
                    <input type="number" name="jml_anak" id="jml_anak" placeholder="Jumlah Anak - Anak" required>
                    <input type="text" name="total" id="total" placeholder="Total Bayar" required>
                    <input type="text" name="nik" id="nik" placeholder="NIK" required>
                    <input type="text" name="nama" id="nama" placeholder="Nama Lengkap" required>
                    <input type="email" name="email" id="email" placeholder="Email (Example@email.com)"><br>
                    <button type="submit">Simpan</button>
                    <button type="reset">Resset Data</button>
                </form>
            </div>
        </main>
    </body>
</html>