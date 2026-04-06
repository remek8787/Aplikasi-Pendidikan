<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

$exec = mysqli_query($koneksi, "truncate trx_bayar");
$exec = mysqli_query($koneksi, "truncate m_bayar");
$exec = mysqli_query($koneksi, "truncate tmpbayar");
$exec = mysqli_query($koneksi, "truncate gaji");
$exec = mysqli_query($koneksi, "truncate jadwal_tu");
?>