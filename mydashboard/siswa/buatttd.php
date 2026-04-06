<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
   $id = $_POST['id'];
    $guru = $_POST['guru'];
	$sig_string=$_POST['signature'];
	$nama_file="../../images/ttd/ttd_".date("his").".png";
	file_put_contents($nama_file, file_get_contents($sig_string));
	$file = "ttd_".date("his").".png";
	mysqli_query($koneksi,"UPDATE pkl_kegiatan SET ttd='$file',instruktur='$guru' where id='$id'");
?>