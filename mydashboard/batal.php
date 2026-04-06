<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");

	$id = $_POST['id'];
	
	$hapus = mysqli_query($koneksi,"DELETE FROM transaksi_kantin WHERE id='$id'");
?>