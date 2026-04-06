<?php
require("konek/koneksi.php");
require("konek/dis.php");
(isset($_SESSION['id_siswa'])) ? $id_siswa = $_SESSION['id_siswa'] : $id_siswa = 0;
mysqli_query($koneksi, "UPDATE siswa set online='0' where id_siswa='$id_siswa'");
session_destroy();
echo "<script>location.href = '.';</script>";
?>