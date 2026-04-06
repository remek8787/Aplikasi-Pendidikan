<?php
require("konek/koneksi.php");
require("konek/function.php");
require("konek/crud.php");
$cek = rowcount($koneksi, 'token', ['token' => $_POST['token']]);
    if ($cek > 0) {
        echo "OK";
    } else {
   echo "gagal";
}
?>