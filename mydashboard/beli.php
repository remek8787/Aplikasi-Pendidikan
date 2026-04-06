<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");
$id_siswa = $_SESSION['id_siswa'];
$siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa  WHERE id_siswa='$id_siswa'"));
$tanggal = date('Y-m-d');
$reff = date('YmdHis');
$query = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE idsiswa='$id_siswa'"); 
while ($data = mysqli_fetch_array($query)) :
	$ids = $data['idsiswa'];
	$idp = $data['idproduk'];
	$jumlah = $data['jumlah'];
	$harga = $data['harga'];
	$total = $jumlah * $harga;
	$prod = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM produk  WHERE produk_id='$idp'"));
	
	$simpan = mysqli_query($koneksi,"INSERT INTO transaksi_kantin(tanggal,idsiswa,idproduk,jumlah,harga,total_harga,status) 
	VALUES('$tanggal','$ids','$idp','$jumlah','$harga','$total','0')");
	if($simpan){
		mysqli_query($koneksi,"DELETE FROM keranjang WHERE idsiswa='$id_siswa'");
		$trx = mysqli_fetch_array(mysqli_query($koneksi, "SELECT idsiswa,SUM(total_harga) AS total FROM transaksi_kantin  WHERE idsiswa='$id_siswa' AND status='0'"));
	$exec = mysqli_query($koneksi,"INSERT INTO invoice(tanggal,idsiswa,nama,total,reff) VALUES('$tanggal','$id_siswa','$siswa[nama]','$trx[total]','$reff')");
	    if($exec){
			mysqli_query($koneksi,"UPDATE transaksi_kantin SET status='1' WHERE idsiswa='$id_siswa' AND status='0'");
			
		}
	}
endwhile;
mysqli_close($koneksi);
?>