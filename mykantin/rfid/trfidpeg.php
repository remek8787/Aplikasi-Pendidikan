<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

	$ids = $_POST['ids'];
	$kartu = $_POST['nokartu'];
	$query = mysqli_query($koneksi, "select * from users where nokartu='$kartu'");
    $cek = mysqli_num_rows($query);
	if ($cek ==0) {
	$simpan = mysqli_query($koneksi,"UPDATE users SET nokartu='$kartu' WHERE id_user='$ids'");
	
	}
	mysqli_query($koneksi, "TRUNCATE tmpreg");
  mysqli_close($koneksi);
?>