<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
$tanggal = $_POST['tanggal'];
$ids = $_POST['idsiswa'];
$kelas = $_POST['kelas'];
$mapel = $_POST['mapel'];
$guru = $_POST['guru'];
$nilai = $_POST['nilai'];
$smt = $setting['semester'];
$tapel = $setting['tp'];	
	
$count = count($_POST['kelas']);
$sql   = "INSERT INTO nilai_harian(idsiswa,tanggal,kelas,mapel,nilai,guru,smt,tp) VALUES ";
for( $i=0; $i < $count; $i++ )
	
{
$sql .= "('{$ids[$i]}','{$tanggal[$i]}','{$kelas[$i]}','{$mapel[$i]}','{$nilai[$i]}','{$guru[$i]}','{$smt}','{$tapel}')";
$sql .= ",";
}
$sql = rtrim($sql,",");
$exec = $koneksi->query($sql);

?>