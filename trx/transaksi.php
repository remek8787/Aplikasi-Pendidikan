<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");
$tahun = date('Y');
$kartu = $_POST['uid'];
$bulane = fetch($koneksi,'bulan',['bln'=>$bulan]);
$siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa  WHERE nokartu='$kartu'"));
$ids = $siswa['id_siswa'];
$jsiswa = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa where nokartu='$kartu'"));
if($jsiswa==0):
echo "GAGAL";
else:
  echo "      SMK SADAM CISURUPAN       \n";
  echo "  Jalan Serang RT. 006 RW. 005  \n";
  echo "================================\n";
  echo "        CETAK TRANSAKSI         \n\n";  
  echo "Nama   : ".substr($siswa['nama'],0,22)."\n";
  echo "Kelas  : ".$siswa['kelas']."\n";
  echo "Bulan  : ".$bulane['ket']." ".$tahun."\n";
  echo "================================\n";
  echo "TANGGAL     DEBET     KREDIT  \n";
  
$query = mysqli_query($koneksi, "SELECT * FROM saldo WHERE idsiswa='$ids'"); 
 while ($data = mysqli_fetch_assoc($query)){
 echo $data['tanggal']. " " .number_format($data['debet']). "    ".number_format($data['kredit'])."\n";
 }
  echo "================================\n";
  echo "Saldo  : RP ".number_format($siswa['saldo'])."\n";
  
endif;

?>