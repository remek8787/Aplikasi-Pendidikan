<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
$kode = $_POST['id'];

$query = "SELECT * FROM materi WHERE idm='".$kode."'";
$sql = mysqli_query($koneksi, $query); 
$data = mysqli_fetch_array($sql);

if(is_file("../../materi/".$data['file'])) 
unlink("../../materi/".$data['file']); 

$exec = mysqli_query($koneksi, "DELETE FROM materi WHERE idm='$kode'");
$exec = mysqli_query($koneksi, "DELETE FROM komentar WHERE idm='$kode'");
$exec = mysqli_query($koneksi, "DELETE FROM soal_quiz WHERE idmateri='$kode'");
$exec = mysqli_query($koneksi, "DELETE FROM absen_daringmapel WHERE idmateri='$kode'");
