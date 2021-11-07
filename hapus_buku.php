<?php
ob_start();
include"koneksi.php";
include"valid-page-user.php";
if(isset($_GET['isbn'])){
	$isbn		= $_GET['isbn'];
	$sql_foto	= mysql_query("select * from buku where isbn='$isbn'");
	$data_foto	= mysql_fetch_array($sql_foto);
	$foto		= $data_foto['gambar'];
	$sql		= mysql_query("delete from buku where isbn='$isbn'");
	if($sql){
		unlink("img/".$foto);
		header("location:tampilbuku.php");
	}else{
		?>
        <script>alert('Data gagal dihapus'); history.back();</script>
        <?php
	}
}
ob_flush();
?>