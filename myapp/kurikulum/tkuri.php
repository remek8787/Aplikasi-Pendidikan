<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

    $level = $_POST['level'];
	$kuri = $_POST['kuri'];
	$result = mysqli_query($koneksi,"UPDATE kelas SET kuri='$kuri' WHERE level='$level'"); 