<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

if ($pg == 'spi') {
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
		'pred'=>$_POST['pred'],
		'ket'=>$ki,
		'guru'=>$guru,
		'smt'=>$semester,
		'tp'=>$tapel
		  ];
	if($rendah<>$tinggi):
		
		$exec = insert($koneksi, 'nilai_sikap', $data);
		 echo "OK";
	else:
	echo "gagal";
	endif;
}
if ($pg == 'sos') {
$ki = $_POST['ki'];
$ids = $_POST['ids'];
$kelas = $_POST['kelas'];	
$mapel = $_POST['mapel'];	
$guru = $_POST['guru'];
 $rendah = $_POST['rendah'];
 $tinggi = implode(', ',$_POST['tinggi']);
			$array= $_POST['tinggi'];
				$k1=$array[0];
				$k2=$array[1];
				$k3=$array[2];
				$k4=$array[3];
				$k5=$array[4];
				$k6=$array[5];
				$k7=$array[6];	
	$data =[
		'idsiswa'=>$ids,
		'kelas'=>$kelas,
		'mapel'=>$mapel,
		'desmin'=>$rendah,
		'desmax'=>$tinggi,
		'pred'=>$_POST['pred'],
		'ket'=>$ki,
		'guru'=>$guru,
		'smt'=>$semester,
		'tp'=>$tapel
		  ];
	if($rendah==$k1 OR $rendah==$k2 OR $rendah==$k3 OR $rendah==$k4 OR $rendah==$k5 OR $rendah==$k6 OR $rendah==$k7){
	  echo"gagal";
	 }else{
		 $exec = insert($koneksi, 'nilai_sikap', $data);
		 echo "OK";
	 }
}