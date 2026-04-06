<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

$ki = $_POST['ki'];
$ids = $_POST['idsiswa'];
$kelas = $_POST['kelas'];
$mapel = $_POST['mapel'];
$level = $_POST['level'];
$guru = $_POST['guru'];
$nilai = $_POST['nilai'];
$ket = $_POST['ket'];

$count = count($_POST['kelas']);
for( $i=0; $i < $count; $i++ ){
	$qus = mysqli_query($koneksi, "SELECT * FROM nilai_rapor WHERE idsiswa='$ids[$i]' and mapel='$mapel[$i]' and ket='$ket[$i]' and ki='$ki[$i]' and smt='$semester' and tp='$tapel'");
     $cek = mysqli_num_rows($qus);
            if ($cek == 0) {
	$result = mysqli_query($koneksi,"INSERT INTO nilai_rapor (mapel,idsiswa,level,kelas,guru,ki,nilai,ket,smt,tp)
	VALUES('$mapel[$i]','$ids[$i]','$level[$i]','$kelas[$i]','$guru[$i]','$ki[$i]','$nilai[$i]','$ket[$i]','$semester','$tapel')");
			}else{
	$result = mysqli_query($koneksi,"UPDATE nilai_rapor SET nilai='$nilai[$i]' WHERE idsiswa='$ids[$i]' and mapel='$mapel[$i]' and ket='$ket[$i]' and ki='$ki[$i]' and smt='$semester' and tp='$tapel'");					
			}

}

?>