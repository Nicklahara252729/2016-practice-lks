<?php
include"koneksi.php";
if(isset($_POST['kode_train'])){
    $kode_kereta = strip_tags(trim($_POST['kode_train']));
    $nama_kereta = strip_tags(trim($_POST['nama_kereta']));
    $gerbong = strip_tags(trim($_POST['gerbong']));
    $kode_masinis = strip_tags(trim($_POST['kode_masinis']));
    $gambar = $_FILES['file']['name']?$_FILES['file']['name']:"default.jpg";
    $size = $_FILES['file']['size'];
    $sql = mysql_query("select * from kereta where kode_kereta='$kode_kereta'");
    $jml = mysql_num_rows($sql);
    if($jml > 0){
        ?>
<script>alert('Kereta dengan kode <?php echo $kode_kereta; ?> sudah ada');history.back();</script>
<?php
    }else{
        if($size > 2097152){
            ?>
<script>alert('Ukuran gambar terlalu besar')history.back();</script>
<?php
        }else{
            $simpan = mysql_query("insert into kereta set kode_kereta='$kode_kereta', nama_kereta='$nama_kereta', jumlah_gerbong='$gerbong',kode_masinis='$kode_masinis', gambar='$gambar'");
            if($simpan && isset($_FILES['file']['name'])){
                move_uploaded_file($_FILES['file']['tmp_name'],"img/".$gambar);
            }
        }
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
                <p>+ Add New Train</p>
            </div>
            <div class="content" id="content-bawah">
                <form target="_self" name="kereta" id="kereta" enctype="multipart/form-data" method="post">
                    <input type="text" placeholder="Kode Kereta (K-001)" name="kode_train" id="kode_train" required>
                    <input type="text" placeholder="Nama Kereta" id="nama_kereta" name="nama_kereta" required>
                    <input type="number" min="1" name="gerbong" id="gerbong" required placeholder="Jumlah Gerbong">
                    <input type="text" name="kode_masinis" id="kode_masinis" placeholder="Kode Masinis (M-001)" required>
                    <label for="gambar">Gambar Kereta</label><br>
                    <input type="file" name="file" id="file" onblur="cekfile();" onclick="cekfile();" onchange="cekfile();"> <br>
                    Ukura foto maximal 2 Mb.<br>
                    <div id="msgfile"></div><br>
                    <button type="submit">Simpan</button>
                    <button type="reset">Resset Data</button>
                </form>
            </div>
        </main>
    </body>
</html>