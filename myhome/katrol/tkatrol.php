<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

if ($pg == 'katrol') {
	
	$idbank = $_POST['mapel'];
	$kelas = $_POST['kelas'];
    $sql = mysqli_fetch_array(mysqli_query($koneksi, "SELECT id_bank,MIN(nilai) AS kecil, MAX(nilai) as besar FROM nilai where id_bank='$idbank'"));
	$kecil = $sql['kecil'];
	$besar = $sql['besar'];
    $rendah = $_POST['rendah'];
	$tinggi = $_POST['tinggi'];
	
	
	$query = mysqli_query($koneksi, "SELECT * FROM siswa where kelas='$kelas'");
	while ($data = mysqli_fetch_array($query)) :
	$dataxx = mysqli_fetch_array(mysqli_query($koneksi, "SELECT id_nilai,id_bank,id_siswa,nilai FROM nilai where id_bank='$idbank' and id_siswa='$data[id_siswa]'"));
	$nilai = $dataxx['nilai'];
	$katrol = $rendah+($nilai - $kecil)/($besar-$kecil) * ($tinggi-$rendah);
	$katrol = round($katrol);
	mysqli_query($koneksi,"UPDATE nilai set katrol='$katrol' where id_siswa='$data[id_siswa]' and id_bank='$idbank'");
	endwhile;
}
