<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");
$tgl =  date('Y-m-d');
$waktu = date('H:i:s');
$kartu = $_POST['uid'];
$besar = $_POST['besar'];
$siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa  WHERE nokartu='$kartu'"));
$saldoawal = $siswa['saldo'];
$ids = $siswa['id_siswa'];
$tambah = $saldoawal + $besar;
$jsiswa = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa where nokartu='$kartu'"));
if($jsiswa==0):
echo "GAGAL";
else:
$simpan = mysqli_query($koneksi,"UPDATE siswa SET saldo='$tambah' WHERE nokartu='$kartu'");
$simpeun = mysqli_query($koneksi,"INSERT INTO saldo(tanggal,jam,idsiswa,debet,kredit) VALUES('$tgl','$waktu','$ids','$besar','0')");
  echo "      SMK SADAM CISURUPAN       \n";
  echo "  Jalan Serang RT. 006 RW. 005  \n";
  echo "================================\n";
  echo "         TOP UP SALDO           \n\n";  
  echo "Nama   : ".substr($siswa['nama'],0,22)."\n";
  echo "Awal   : RP ".number_format($siswa['saldo'])."\n";
  echo "Top Up : RP ".number_format($besar)."\n";
  echo "Saldo  : RP ".number_format($tambah)."\n";
  echo "Reff   : ".date('YmdHis')."\n";
  echo "================================\n";
  echo "        TERIMA KASIH            \n";
  echo " Cetak pada ".date('d-m-Y H:i:s')." \n\n";

endif;
mysqli_close($koneksi);
?>