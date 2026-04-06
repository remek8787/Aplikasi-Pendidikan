<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

    $bulan = $_POST['bulan'];
    $simpan = delete($koneksi, 'absensi', ['bulan' => $bulan]);
	
?>