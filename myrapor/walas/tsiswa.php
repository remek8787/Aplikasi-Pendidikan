<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

  if ($pg == 'absen') {
	 $ids = $_POST['ids'];
    $sakit = $_POST['sakit'];
	$izin = $_POST['izin'];
	$alpha = $_POST['alpha'];

	$exec = mysqli_query($koneksi,"UPDATE siswa SET sakit='$sakit',izin='$izin',alpha='$alpha' WHERE id_siswa='$ids'");
			                  		
}
  if ($pg == 'catat') {
	 $ids = $_POST['ids'];
    $catat = $_POST['catat'];
	
	
	$exec = mysqli_query($koneksi,"UPDATE siswa SET catatan='$catat' WHERE id_siswa='$ids'");
			                  		
}       
if ($pg == 'prestasi') {
	 $ids = $_POST['ids'];
    $prestasi = $_POST['prestasi'];
	$tingkat = $_POST['tingkat'];
	$juara = $_POST['juara'];

	$exec = mysqli_query($koneksi,"UPDATE siswa SET prestasi='$prestasi',tingkat='$tingkat',juara='$juara' WHERE id_siswa='$ids'");
			                  		
}
?>