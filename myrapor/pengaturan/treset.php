<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
$exec = mysqli_query($koneksi, "truncate nilai_sumatif");
$exec = mysqli_query($koneksi, "truncate nilai_rapor");
$exec = mysqli_query($koneksi, "truncate mapel_rapor");
$exec = mysqli_query($koneksi, "truncate nilai_k13");
$exec = mysqli_query($koneksi, "truncate peskul");
$exec = mysqli_query($koneksi, "truncate nilai_sikap");
$exec = mysqli_query($koneksi, "truncate nilai_formatif");
$exec = mysqli_query($koneksi, "truncate deskripsi");
$exec = mysqli_query($koneksi, "truncate tujuan");
$exec = mysqli_query($koneksi, "update siswa set sakit='0',izin='0',alpha='0',catatan=NULL,prestasi=NULL,tingkat=NULL");
?>