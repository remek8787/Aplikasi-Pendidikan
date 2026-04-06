<?php
require("konek/koneksi.php");
require("konek/function.php");
require("konek/crud.php");
$id_siswa = $_POST['idsis'];
$id_soal = $_POST['idso'];
$jenis = '5';

   $hapus = mysqli_query($koneksi, "DELETE FROM jawaban WHERE id_siswa='$id_siswa' AND  id_soal='$id_soal' AND jenis='$jenis'");
   $hapus = mysqli_query($koneksi, "DELETE FROM jodoh WHERE id_siswa='$id_siswa' AND  id_soal='$id_soal'");
 $hapus = mysqli_query($koneksi, "DELETE FROM jawaban_soal WHERE id_siswa='$id_siswa' AND  id_soal='$id_soal'");

	

?>