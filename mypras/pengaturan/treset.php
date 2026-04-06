<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

$exec = mysqli_query($koneksi, "truncate aset");

?>