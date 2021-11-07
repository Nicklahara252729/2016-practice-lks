<?php
$email ="laharanick@gmail.com";
$subject ="Pembelian Barang";
$Pengirim ="From : Ardiansyah.binjai@gmail.com"."\n\f";
$isi = "Kepada Yth : Ardiansyah. <br> Pesanan Anda Sedang dalam proses pengiriman sambil menunggu konfirmasi pembayaran.<br><br>Terima Kasih telah berbelanja di Website kami!.";
$headers = 'From: <laharanick@gmail.com>' . "rn"; //bagian ini diganti sesuai dengan email dari pengirim
@mail($email, $subject, $isi, $headers);
if(@mail) 
{
    echo "pengiriman berhasil";
}
else 
{
    echo "pengiriman gagal";
}
?>