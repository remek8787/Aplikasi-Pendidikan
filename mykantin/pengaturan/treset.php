<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

$exec = mysqli_query($koneksi, "truncate transaksi_kantin");
$exec = mysqli_query($koneksi, "truncate produk");
$exec = mysqli_query($koneksi, "truncate saldo");
$exec = mysqli_query($koneksi, "truncate kategori");
$exec = mysqli_query($koneksi, "truncate keranjang");
$exec = mysqli_query($koneksi, "truncate toko");
$exec = mysqli_query($koneksi, "truncate invoice");

$exec = mysqli_query($koneksi, "UPDATE siswa SET saldo='0', nokartu=NULL");
$exec = mysqli_query($koneksi, "UPDATE users SET saldo='0', nokartu=NULL");

$gambar = glob('../../gambar/produk/*'); 
foreach ($gambar as $filex) {
    if (is_file($filex))
        unlink($filex); 
}
?>