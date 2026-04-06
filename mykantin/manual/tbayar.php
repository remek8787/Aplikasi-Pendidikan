<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
$bulan = date('m');
$tahun = date('Y');
$tanggal = date('Y-m-d');
$query = mysqli_query($koneksi, "SELECT * FROM keranjang"); 
while ($data = mysqli_fetch_array($query)) :
$barang = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM produk where produk_id='$data[idproduk]'"));
 $jum = $barang['produk_jumlah'];
 $jumbarang = $jum - $data['jumlah'];
 $simpan = mysqli_query($koneksi,"UPDATE produk SET produk_jumlah='$jumbarang' WHERE produk_id='$data[idproduk]'");
 
 if($simpan){
	 $simpeun = mysqli_query($koneksi,"INSERT  INTO transaksi_kantin(tanggal,idsiswa,idproduk,jumlah,harga,total_harga,status,bulan,tahun) VALUES('$tanggal','$data[idsiswa]','$data[idproduk]','$data[jumlah]','$data[harga]','$data[total]','2','$bulan','$tahun')");
	 mysqli_query($koneksi,"truncate keranjang");
 }
endwhile;
?>