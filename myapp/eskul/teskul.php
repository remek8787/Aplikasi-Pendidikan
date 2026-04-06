<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

if ($pg == 'tambah') {
	 $kode = $_POST['eskul'];
	  $guru = $_POST['guru'];
    $cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM m_eskul WHERE eskul='$kode' AND guru='$guru'"));
        if ($cek > 0) :
            echo "0";
        else :
		
        $result= mysqli_query($koneksi, "INSERT INTO m_eskul (eskul,guru) VALUES ('$kode','$guru')");
			
       endif;
}
if ($pg == 'hapus') {
    $id = $_POST['id'];
    $result= delete($koneksi, 'm_eskul', ['id' => $id]);
    
}
