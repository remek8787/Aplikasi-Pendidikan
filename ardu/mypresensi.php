<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");

$kartu = $_GET['nokartu'];
$datareg = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM datareg  WHERE nokartu='$kartu'"));
if($datareg['level']=='siswa'):
$siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa  WHERE id_siswa='$datareg[idsiswa]'"));
$jsiswa = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa where id_siswa='$datareg[idsiswa]'"));
if($jsiswa==0):
echo "GAGAL";
else:
$hadir = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi where idsiswa='$siswa[id_siswa]' and bulan='$bulan' and tahun='$tahun' and ket='H'"));
$sakit = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi where idsiswa='$siswa[id_siswa]' and bulan='$bulan' and tahun='$tahun' and ket='S'"));
$izin = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi where idsiswa='$siswa[id_siswa]' and bulan='$bulan' and tahun='$tahun' and ket='I'"));
$alpha = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi where idsiswa='$siswa[id_siswa]' and bulan='$bulan' and tahun='$tahun' and ket='A'"));

echo "H:".$hadir." S:".$sakit." I:".$izin." A:".$alpha;
endif;
endif;



if($datareg['level']=='pegawai'):
$peg = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM users  WHERE id_user='$datareg[idpeg]'"));
$jpeg = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM users where id_user='$datareg[idpeg]'"));
if($jpeg==0):
echo "GAGAL";
else:
$hadir = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi where idpeg='$peg[id_user]' and bulan='$bulan' and tahun='$tahun' and ket='H'"));
$sakit = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi where idpeg='$peg[id_user]' and bulan='$bulan' and tahun='$tahun' and ket='S'"));
$izin = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi where idpeg='$peg[id_user]' and bulan='$bulan' and tahun='$tahun' and ket='I'"));
$alpha = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi where idpeg='$peg[id_user]' and bulan='$bulan' and tahun='$tahun' and ket='A'"));

echo "H:".$hadir." S:".$sakit." I:".$izin." A:".$alpha;
endif;
endif;
mysqli_close($koneksi);
?>