<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");
$idsoal = $_POST['idsoal'];
$idsiswa = $_POST['idsiswa'];
$kelas = $_POST['kelas'];
$jawab = $_POST['jawab'];
$mapel = $_POST['mapel'];
	
$count = count($_POST['jawab']);
$sql   = "INSERT INTO jawaban_refleksi(idsiswa,tanggal,kelas,idmapel,idsoal,jawaban) VALUES ";
for( $i=0; $i < $count; $i++ )
	
{
$sql .= "('{$idsiswa[$i]}','$tanggal','{$kelas[$i]}','{$mapel[$i]}','{$idsoal[$i]}','{$jawab[$i]}')";
$sql .= ",";
}
$sql = rtrim($sql,",");
$exec = $koneksi->query($sql);

?>