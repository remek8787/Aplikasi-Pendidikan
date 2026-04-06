<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");
mysqli_query($koneksi, "TRUNCATE tmpreg");
$kartu = $_GET['nokartu'];
$datareg = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM datareg  WHERE nokartu='$kartu'"));
if($datareg['level']=='siswa'):
$siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa  WHERE nokartu='$datareg[nokartu]'"));
$jsiswa = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa where nokartu='$datareg[nokartu]'"));
if($jsiswa==0):
$exec = mysqli_query($koneksi,"INSERT INTO tmpreg(nokartu) VALUES('$kartu')");
echo "GAGAL";
else:
  echo " ".number_format($siswa['saldo']);
endif;
endif;
if($datareg['level']=='pegawai'):
$peg = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM users  WHERE nokartu='$datareg[nokartu]'"));
$jpeg = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM users where nokartu='$datareg[nokartu]'"));
if($jpeg==0):
$exec = mysqli_query($koneksi,"INSERT INTO tmpreg(nokartu) VALUES('$kartu')");
echo "GAGAL";
else:
  echo " ".number_format($peg['saldo']);
endif;
endif;
mysqli_close($koneksi);
?>