<?php
include"koneksi.php";
if(isset($_POST['katakunci'])){
$key=$_POST['katakunci'];
    //if(isset($_POST['pilih'])){
        $pilih = $_POST['pilih'];
        $sql=mysql_query("select * from user where level='$pilih' like '%$key%' ");
    //}else{
//$sql=mysql_query("select * from user where username like '%$key%' ");
  //  }
}else{
$sql=mysql_query("select * from user");
}
$jml=mysql_num_rows($sql);

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<form  target="_self" method="get" enctype="multipart/form-data" id="cari" name="cari">
<input type="text" id="katakunci" name="katakunci" placeholder="Kata Kunci"><br>
<button type="submit">Cari</button>
</form>
<form  target="_self" method="post" enctype="multipart/form-data" id="cari" name="cari">
    <select name="pilih">
        <option value="admin">admin</option>
        <option value="member">member</option>
    </select>
<input type="text" id="katakunci" name="katakunci" placeholder="Kata Kunci"><br>
<button type="submit">Cari</button>
</form>
<?php
    if($jml > 0){
while ($r=mysql_fetch_array($sql)){
	?>
    <table>
    <tr>
    <td><?php echo $r['username'];?></td></td>
    </tr>
    </table>
    <?php
}
}else{
    echo"not found";
}
?>
</body>
</html>