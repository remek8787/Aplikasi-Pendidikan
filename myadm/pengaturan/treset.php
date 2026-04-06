<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
$exec = mysqli_query($koneksi, "truncate sk_peg");
$exec = mysqli_query($koneksi, "truncate surat_tugas");
?>