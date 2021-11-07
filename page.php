<?php
include"koneksi.php";
$batas=1;
if(!isset($_GET['halaman'])){
	$halaman=1;
	$posisi=0;
}else{
	$halaman=$_GET['halaman'];
	$posisi=($halaman-1) * $batas;
}
$tampil=mysql_query("select * from user limit $posisi,$batas");
?>
<!doctype html>
<html>
    <head>
        <style>
            #photo{
                width: 100px;
                height: 100px;
            }
            .paging{
                text-align: center;
            }
        </style>
        <meta charset="utf-8">
        <title>pagination</title>
    </head>
    <body>
        <table align="center" border="1">
            <tr>
                <th>No</th>
                <th>Photo User</th>
                <th>Nama User</th>
                <th>Username</th>
                <th>Email</th>
                <th>Level</th>
            </tr>
           <?php
		   $no=$posisi+1;
		   while ($r=mysql_fetch_array($tampil)){
			   ?>
               <tr>
               <td><?php echo $no.".";?></td></td>
               <td><img id="photo" src="img/<?php echo $r['foto']; ?>"</td>
               <td><?php echo $r['nama']; ?></td>
               <td><?php echo $r['username']; ?></td>
               <td><?php echo $r['email']; ?></td>
               <td><?php echo $r['level']; ?></td>
               </tr>
               <?php
			   $no++;
		   }
		   ?>
        </table><br>
        <?php
        $tampil2         = mysql_query("select * from user");
        $jumlahdata      = mysql_num_rows($tampil2);
        $jmlhal          = ceil($jumlahdata/$batas);
        ?>
        <div class="paging">
            <?php
            if($halaman > 1){
                $prev=$halaman-1;
                echo"<span class='prevnext'><a href='$_SERVER[PHP_SELF]?halaman=$prev'><< Prev</a></span>";
            }else{
                echo"<span class='disabled'><< Prev</span>";
            }
            for($i=1;$i<=$jmlhal;$i++)
                if($i!=$halaman){
                    echo"<a href='$_SERVER[PHP_SELF]?halaman=$i'>$i</a>";
                }
                else{
                    echo"<span class'current'>$i</span>";
                }
                if($halaman < $jmlhal){
                    $next=$halaman+1;
                    echo"<span class='prevnext'><a href=$_SERVER[PHP_SELF]?halaman=$next>Next >></a></span>";
                }else{
                    echo"<span class='disabled'>Next >></span>";
                }
            
            ?>
        </div>
        <p align="center">Total Anggota : <b><?php echo $jumlahdata; ?></b> orang</p>
    </body>
</html>
