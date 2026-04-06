<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");
$id = $_POST['id'];
	
	$hapus = mysqli_query($koneksi,"UPDATE transaksi_kantin SET status='3' WHERE id='$id'");
?>