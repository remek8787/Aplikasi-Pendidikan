<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
$ki = $_POST['ki'];
$ids = $_POST['ids'];
$kelas = $_POST['kelas'];	
$mapel = $_POST['mapel'];	
$guru = $_POST['guru'];
$tinggi = $_POST['tinggi'];
$rendah = $_POST['rendah'];

		$data =[
		'idsiswa'=>$ids,
		'kelas'=>$kelas,
		'mapel'=>$mapel,
		'desmin'=>$rendah,
		'desmax'=>$tinggi,
		'ket'=>$ki,
		'guru'=>$guru,
		'smt'=>$semester,
		'tp'=>$tapel
		  ];
	if($rendah<>$tinggi):
		
		$exec = insert($koneksi, 'nilai_k13', $data);
		 echo "OK";
	else:
	echo "gagal";
	endif;

?>