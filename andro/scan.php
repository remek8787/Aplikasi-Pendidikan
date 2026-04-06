<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");


$kode = $_POST['uid'];
mysqli_query($koneksi,"INSERT INTO tmpbuku(kode) VALUES('$kode')");
echo "1";
?>