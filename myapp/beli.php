<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");
$iduser = $_SESSION['id_user'];
$peg = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM users  WHERE id_user='$iduser'"));
$tanggal = date('Y-m-d');
$reff = date('YmdHis');
$query = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE idpeg='$iduser'"); 
while ($data = mysqli_fetch_array($query)) :
	$ids = $data['idpeg'];
	$idp = $data['idproduk'];
	$jumlah = $data['jumlah'];
	$harga = $data['harga'];
	$total = $jumlah * $harga;
	$prod = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM produk  WHERE produk_id='$idp'"));
	
	$simpan = mysqli_query($koneksi,"INSERT INTO transaksi_kantin(tanggal,idpeg,idproduk,jumlah,harga,total_harga,status) 
	VALUES('$tanggal','$iduser','$idp','$jumlah','$harga','$total','0')");
	if($simpan){
		mysqli_query($koneksi,"DELETE FROM keranjang WHERE idpeg='$iduser'");
		$trx = mysqli_fetch_array(mysqli_query($koneksi, "SELECT idpeg,SUM(total_harga) AS total FROM transaksi_kantin  WHERE idpeg='$iduser' AND status='0'"));
	$exec = mysqli_query($koneksi,"INSERT INTO invoice(tanggal,idpeg,nama,total,reff) VALUES('$tanggal','$iduser','$peg[nama]','$trx[total]','$reff')");
	    if($exec){
			mysqli_query($koneksi,"UPDATE transaksi_kantin SET status='1' WHERE idpeg='$iduser' AND status='0'");
			
		}
	}
endwhile;
mysqli_close($koneksi);
?>