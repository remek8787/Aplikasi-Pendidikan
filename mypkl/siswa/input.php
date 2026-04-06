<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
$tanggal = $_POST['tanggal'];
$ids = $_POST['idsiswa'];
$kelas = $_POST['kelas'];
$nilai = $_POST['nilai'];
$idn = $_POST['idn'];
	
$count = count($_POST['idsiswa']);

for( $i=0; $i < $count; $i++ ){
    $qus = mysqli_query($koneksi, "SELECT * FROM pkl_nilai WHERE idsiswa='$ids[$i]' and ida='$idn[$i]'");
        $cek = mysqli_num_rows($qus);
           if ($cek == 0) {
			$simpan = mysqli_query($koneksi,"INSERT INTO pkl_nilai(idsiswa,kelas,tanggal,ida,nilai) VALUES('$ids[$i]','$kelas[$i]','$tanggal[$i]','$idn[$i]','$nilai[$i]')");	
			}else{
             $simpan = mysqli_query($koneksi,"UPDATE pkl_nilai SET nilai='$nilai[$i]' WHERE idsiswa='$ids[$i]' and ida='$idn[$i]'");
			}				
				
}


?>