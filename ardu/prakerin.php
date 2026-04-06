<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");
$jumlah = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pkl_kegiatan WHERE status='0' and kegiatan<>'' and tanggal='$tanggal'"));
if($jumlah==0):
echo "GAGAL";
else : 
mysqli_query($koneksi,"UPDATE pkl_kegiatan SET status='1',catatan='Baik dalam melaksanakan kegiatan hari ini' where status='0'"); 

endif;

$jurnal = mysqli_num_rows(mysqli_query($koneksi, "SELECT status FROM pkl_jurnal WHERE tanggal='$tanggal'"));
if($jurnal==0):

else : 
mysqli_query($koneksi,"UPDATE pkl_jurnal SET status='1' where status='0'"); 

endif;		
?>