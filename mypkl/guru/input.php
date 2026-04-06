<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

$ids = $_POST['ids'];
$kelas = $_POST['kelas'];
$jawab = $_POST['jawab'];
$idm = $_POST['idm'];
	
$count = count($_POST['ids']);

for( $i=0; $i < $count; $i++ ){
    $qus = mysqli_query($koneksi, "SELECT * FROM pkl_evaluasi WHERE idsiswa='$ids[$i]' and idm='$idm[$i]'");
        $cek = mysqli_num_rows($qus);
           if ($cek == 0) {
			$simpan = mysqli_query($koneksi,"INSERT INTO pkl_evaluasi(idsiswa,kelas,idm,jawab) VALUES('$ids[$i]','$kelas[$i]','$idm[$i]','$jawab[$i]')");	
			}else{
             $simpan = mysqli_query($koneksi,"UPDATE pkl_evaluasi SET jawab='$jawab[$i]' WHERE idsiswa='$ids[$i]' and idm='$idm[$i]'");
			}				
				
}


?>