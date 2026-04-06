<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

$ids = $_POST['ids'];
$kelas = $_POST['kelas'];	
$mapel = $_POST['mapel'];	
$guru = $_POST['guru'];
$jumlah = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nilai_formatif WHERE idsiswa='$ids' AND mapel='$mapel' and guru='$guru' and smt='$semester' and tp='$tapel'"));
if($jumlah<>0){
	echo 'gagal';
}else{
$tinggi = implode($_POST['tinggi'], ', ');
$rendah = implode($_POST['rendah'], ', ');


if($tinggi<>$rendah):

	$exec = mysqli_query($koneksi, "INSERT INTO nilai_formatif (idsiswa,kelas,mapel,tinggi,rendah,smt,tp,guru) VALUES ('$ids','$kelas','$mapel','$tinggi','$rendah','$semester','$tapel','$guru')");

echo 'OK';
endif;
}
	
?>