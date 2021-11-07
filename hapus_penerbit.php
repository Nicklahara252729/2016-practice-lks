<?php
ob_start();
include"koneksi.php";
include"valid-page-user.php";
if(isset($_GET['kode_penerbit'])){
	$kode	= strip_tags(trim($_GET['kode_penerbit']));
	$sql	= mysql_query("delete from penerbit where kode_penerbit='$kode'");
	if($sql){
		header("location:tampilpenerbit.php");
	}else{
		?>
        <script>alert('Data gagal di dapus');</script>
        <?php
	}
}
mysql_close($koneksi);
ob_flush();
?>