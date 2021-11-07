<?php
include"koneksi.php";
$sql=mysql_query("select * from buku");
$r= mysql_fetch_array($sql);
if(isset($_FILES['file']['name'])){
    $getfile = $_FILES['file']['name'];
    $getfilea = $_FILES['filegambar']['name'];
    $getfileb = $_FILES['filedoc']['name'];
    //$exten = $_FILES['file']['type'];
    $format = pathinfo($getfile, PATHINFO_EXTENSION);
    $formata = pathinfo($getfilea, PATHINFO_EXTENSION);
    $formatb = pathinfo($getfileb, PATHINFO_EXTENSION);
    $conf   = $r['judul']."cv".".".$format;
    $confa   = $r['judul']."ex".".".$formata;
    $confb   = $r['judul']."doc".".".$formatb;
    move_uploaded_file($_FILES['file']['tmp_name'],"img/".$conf);
    move_uploaded_file($_FILES['filegambar']['tmp_name'],"img/".$confa);
    move_uploaded_file($_FILES['filedoc']['tmp_name'],"img/".$confb);
}
?>
<script type="text/javascript">
    function cek(){
        var file = document.getElementById('file');
        var info = file.files[0];
        var name = info.name;
        document.getElementById('msg').innerHTML= name;
    }
    function cek1(){
        var file = document.getElementById('filegambar');
        var info = file.files[0];
        var name = info.name;
        document.getElementById('msg1').innerHTML= name;
    }
    function cek2(){
        var file = document.getElementById('filedoc');
        var info = file.files[0];
        var name = info.name;
        document.getElementById('msg2').innerHTML= name;
    }
</script>
<form enctype="multipart/form-data" method="post" name="up" id="up" target="_self">
    <label for="file">Pilih File</label><br>
    <div id="msg"></div>
    <input type="file" name="file" id="file" onblur="cek()"  onchange="cek()">
    <div id="msg1"></div>
    <input type="file" name="filegambar" id="filegambar" onblur="cek1()"  onchange="cek1()">
    <div id="msg2"></div>
    <input type="file" name="filedoc" id="filedoc" onblur="cek2()"  onchange="cek2()">
    <button type="submit">upload</button>
</form>