<?php
require("konek/koneksi.php");
require("konek/function.php");
require("konek/crud.php");

mysqli_query($koneksi, "TRUNCATE tmpface");
$status = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM status"));	
$nokartu = $_GET['nokartu'];
$query = mysqli_query($koneksi, "select * from datareg where nokartu='$nokartu' and folder<>''");
$cek = mysqli_num_rows($query);
$data = mysqli_fetch_array($query);
$nama = $data['nama'];

if ($cek ==0) {
	echo "TIDAK TERDAFTAR";
	$exec = mysqli_query($koneksi,"INSERT INTO tmpface(nokartu) VALUES('$nokartu')");
	}else{
	echo $nama;
	$exec = mysqli_query($koneksi,"INSERT INTO tmpface(nokartu) VALUES('$nokartu')");
	}
	mysqli_close($koneksi);
			?>