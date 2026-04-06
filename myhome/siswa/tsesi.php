<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
$sesi = $_POST['sesi'];
$dari = $_POST['dari'];
$sampai = $_POST['sampai'];
mysqli_query($koneksi,"UPDATE siswa set sesi='$sesi' WHERE   id_siswa BETWEEN '$dari' AND '$sampai'");
?>