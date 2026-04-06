<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

    $jurusan = $_POST['jurusan'];
	$bk = $_POST['bk'];
	$pk = $_POST['pk'];
	$kk = $_POST['kk'];
	$result = mysqli_query($koneksi,"UPDATE kelas SET bk='$bk',pk='$pk',kk='$kk' WHERE jurusan='$jurusan'"); 