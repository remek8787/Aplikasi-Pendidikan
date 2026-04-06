<?php
require("konek/koneksi.php");
require("konek/function.php");
require("konek/crud.php");
$hari = date('D');
$waktusandik = date('H:i');
$waktu = date('H:i:s');
$bulan = date('m');
$tahun =date('Y');
$sql = mysqli_query($koneksi, "select * from status");
	$data = mysqli_fetch_array($sql);
	$mode_absen = $data['mode'];
	$mode = "";
	if($mode_absen==1){
		echo $waktusandik." >>>> Masuk";	
	}else if($mode_absen==2){
		echo $waktusandik." >>> Pulang";
	}else if($mode_absen==3){
		echo $waktusandik." Masuk Les ";
	}else if($mode_absen==4){
		echo $waktusandik." Pulang Les ";
	}


$queryxxx = mysqli_query($koneksi,"SELECT * FROM waktu WHERE hari='$hari'");
$dataqx = mysqli_fetch_array($queryxxx);

if($waktu == date('H:i:s',strtotime($dataqx['alpha']))):
$q = mysqli_query($koneksi,"SELECT id_siswa,kelas FROM siswa WHERE NOT EXISTS(SELECT idsiswa,tanggal,kelas FROM absensi WHERE siswa.id_siswa=absensi.idsiswa AND absensi.tanggal='$tanggal')");
while ($sis = mysqli_fetch_array($q)):
 $cek22 = mysqli_num_rows(mysqli_query($koneksi, "SELECT idsiswa,tanggal FROM absensi WHERE idsiswa='$sis[id_siswa]' AND tanggal='$tanggal'"));
    if ($cek22 == 0) {
		$edis = mysqli_query($koneksi,"INSERT INTO absensi(tanggal,idsiswa,kelas,ket,masuk,pulang,level,bulan,tahun) VALUES('$tanggal','$sis[id_siswa]','$sis[kelas]','A','$waktu','$waktu','siswa','$bulan','$tahun')");
  
  }

endwhile;
endif;

?>