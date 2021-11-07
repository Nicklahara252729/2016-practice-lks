<?php
ob_start();
include"koneksi.php";
if(isset($_GET['kode_penulis'])){
	$kode		= strip_tags(trim($_GET['kode_penulis']));
	$sql_foto	= mysql_query("select * from penulis where kode_penulis='$kode'");
	$data		= mysql_fetch_array($sql_foto);
	$foto		= $data['photo'];
	$sql		= mysql_query("delete from penulis where kode_penulis='$kode'");
	if($sql){
		unlink("img/".$foto);
		header("location:tampilpenulis.php");
	}else{
		?>
        <script>alert('Data gagal di dapus');</script>
        <?php
	}
}
mysql_close($koneksi);
ob_flush();
?>