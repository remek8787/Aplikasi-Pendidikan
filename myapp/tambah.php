<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");

	$ids = $_POST['ids'];
	$idp = $_POST['idp'];
	$jumlah = $_POST['jumlah'];
	$harga = $_POST['harga'];
	
	$cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM keranjang  WHERE idpeg='$ids' AND idproduk='$idp'"));
    if ($cek == 0) {
		$simpan = mysqli_query($koneksi,"INSERT INTO keranjang(idpeg,idproduk,jumlah,harga) VALUES('$ids','$idp','$jumlah','$harga')");
		
	}else{
		$produk = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM keranjang  WHERE idpeg='$ids' AND idproduk='$idp'"));
	$total = $produk['jumlah'] + $jumlah;
	$simpan = mysqli_query($koneksi,"UPDATE keranjang SET jumlah='$total' WHERE idpeg='$ids' AND idproduk='$idp'");

	}
	mysqli_close($koneksi);
?>