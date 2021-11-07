<?php
ob_start();
include"koneksi.php";
if(getenv('HTTP_X_FORWARDED_FOR')){
    $getip = getenv('HTTP_X_FORWARDED_FOR');
}else{
    $getip = getenv('REMOTE_ADDR');
}
if(isset($_GET['kode'])){
    $kode = strip_tags(trim($_GET['kode']));
    $kelas = strip_tags(trim($_GET['kelas']));
    $sql = mysql_query("select * from pesan join kursi on (pesan.kode=kursi.kode)  join kereta on (pesan.idka=kereta.idka) where pesan.kode='$kode'");
    $sql2 = mysql_query("select * from kursi where kode='$kode'");
    $sql3 = mysql_query("select * from kursi where kode='$kode'");
    $num = mysql_num_rows($sql);
    $rows = mysql_fetch_array($sql);
    //echo $num;
        $display ="";
}else{
    $display = "none";
}
?>
<!doctype html>
<html>
    <head>
        <title>Cetak Tiket</title>
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
        <div class="seperdua  padding   <?php echo $display; ?>">
            <div class="penuh text-center font-20 height-50 bor-bottom-dashed line-height-40">
                 Tiket.Com
            </div>
            <div class="penuh text-center font-30">
                <?php echo $rows['kode'];  ?>
            </div>
            <div class="penuh ">
                <table>
                    <tr>
                        <td class="height-30">Pemesan</td>
                        <td class="height-30">:</td>
                        <td class="height-30"><?php echo $rows['pemesan']; ?></td>
                    </tr>
                    <tr>
                        <td class="height-30">Nama KA</td>
                        <td class="height-30">:</td>
                        <td class="height-30"><?php echo $rows['namaka']; ?></td>
                    </tr>
                    <tr>
                        <td class="height-30">Jadwal</td>
                        <td class="height-30">:</td>
                        <td class="height-30"><?php echo $rows['tglberangkat']; ?></td>
                    </tr>
                    <tr>
                        <td class="height-30">Berangkat</td>
                        <td class="height-30">:</td>
                        <td class="height-30"><?php echo $rows['berangkat']; ?></td>
                    </tr>
                    <tr>
                        <td class="height-30">Tiba</td>
                        <td class="height-30">:</td>
                        <td class="height-30"><?php echo $rows['tiba']; ?></td>
                    </tr>
                    <tr>
                        <td class="height-30">Kelas</td>
                        <td class="height-30">:</td>
                        <td class="height-30"><?php echo $rows['kelas']; ?></td>
                    </tr>
                    <tr>
                        <td class="height-30">Data Kursi</td>
                        <td class="height-30">:</td>
                        <td class="height-30">
                            <?php
                            while($rows2 = mysql_fetch_array($sql3)){
                                echo $rows2['nobangku']."<br>";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="height-30">Penumpang</td>
                        <td class="height-30">:</td>
                        <td class="height-30">
                            <?php
                            while($rows3 = mysql_fetch_array($sql2)){
                                echo $rows3['penumpang']."<br>";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="height-30">Total</td>
                        <td class="height-30">:</td>
                        <td class="height-30"><b>Rp <?php echo number_format($rows['harga'],0,',','.'); ?></b></td>
                    </tr>
                </table>
            </div>
            <script>
                window.print();
            </script>
        </div>
    </body>
</html>
<?php
mysql_close($koneksi);
ob_flush();
?>