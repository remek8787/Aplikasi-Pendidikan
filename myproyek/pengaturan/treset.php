<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

$exec = mysqli_query($koneksi, "truncate m_proyek");
$exec = mysqli_query($koneksi, "truncate nilai_proses");
$exec = mysqli_query($koneksi, "truncate nilai_proyek");
$exec = mysqli_query($koneksi, "truncate proyek");

?>