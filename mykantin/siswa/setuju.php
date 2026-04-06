<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
$id = $_POST['idz'];
	
	$hapus = mysqli_query($koneksi,"UPDATE transaksi_kantin SET ket='1' WHERE id='$id'");
?>