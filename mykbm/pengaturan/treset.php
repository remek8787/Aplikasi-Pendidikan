<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
$exec = mysqli_query($koneksi, "truncate agenda");
$exec = mysqli_query($koneksi, "truncate nilai_harian");
$exec = mysqli_query($koneksi, "truncate jadwal_mengajar");
$exec = mysqli_query($koneksi, "truncate cp");
$exec = mysqli_query($koneksi, "truncate cp_elemen");
$exec = mysqli_query($koneksi, "truncate atp");
$exec = mysqli_query($koneksi, "truncate tp");
$exec = mysqli_query($koneksi, "truncate konten");
$exec = mysqli_query($koneksi, "truncate refleksi");
$exec = mysqli_query($koneksi, "truncate jawaban_refleksi");
$exec = mysqli_query($koneksi, "truncate nilai_refleksi");
$exec = mysqli_query($koneksi, "truncate jadwal_refleksi");
$exec = mysqli_query($koneksi, "truncate rpp");
?>