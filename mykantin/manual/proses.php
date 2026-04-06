<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");

	$id = $_POST['id'];
	
	$jumlah = $_POST['jumlah'];
	
	$simpan = mysqli_query($koneksi,"UPDATE keranjang SET jumlah='$jumlah' WHERE id='$id'");
mysqli_close($koneksi);
?>