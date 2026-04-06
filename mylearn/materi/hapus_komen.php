<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
$kode = $_POST['id'];

$exec = mysqli_query($koneksi, "DELETE FROM komentar WHERE id='$kode'");
