<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
	$datax = [
       'kode' => $_POST['kode'],
       'nama_mapel'  => $_POST['nama']
        ];
	$result = insert($koneksi, 'mapel', $datax);
	
?>