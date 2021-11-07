<!DOCTYPE HTML>
<?php
//id(int), nama(var), username(var),password(var), email(var),level(var),photo(var=225) -> utk database
include"koneksi.php";
if(isset($_POST['nama-siswa'])){
    $nama=$_POST['nama-siswa'];
    $nis=$_POST['nis-siswa'];
    $ukuran_gambar=$_FILES['foto']['size'];
    $cek=mysql_query("select * from tb_siswa where nis='$nis'",$koneksi);
    $jumlah=mysql_num_rows($cek);
    if($jumlah > 0){
    ?>
        <script>alert('nis : <?php echo $nis;?> tersebut sudah ada');
            history.back();</script>
    <?php
    }else{
        if($ukuran_gambar>2097152){
        ?>
            <script>alert('ukuran gambar tidak melebihi 2mb'); history.back();</script>
        <?php
        }else{
            $gambar=$_FILES['foto']['name'];
            $simpan=mysql_query("insert into tb_siswa set nis='$nis',nama='$nama',foto='$gambar'"); 
            move_uploaded_file($_FILES['foto']['tmp_name'],'img/'.$_FILES['foto']['name']);
        }
    }
}
 mysql_close($koneksi);
?>
<html>
    <head><title>form siswa</title></head>
    <body>
        <form target="_self" method="post" enctype="multipart/form-data" name="input-siswa" id="input-siswa">
            <label for="nama-siswa">Nama Siswa :</label><br>
            <input type="text" name="nama-siswa" id="nama-siswa"><br>
            <label for="nama-siswa">Nis Siswa :</label><br>
            <input type="text" name="nis-siswa" id="nis-siswa"><br>
            <label for="nama-siswa">Foto Siswa :</label><br>
            <input type="file" name="foto" id="foto"><br>
            <button type="submit" id="nama-siswa">KIRIM</button>
        </form>
    </body>
</html>