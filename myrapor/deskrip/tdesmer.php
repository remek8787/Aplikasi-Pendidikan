<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

if ($pg == 'tambah') {
     $data = [
	   'level'   => $_POST['level'],
		'mapel'   => $_POST['mapel'],
		'lm'   => $_POST['lm'],
		'tujuan'   => $_POST['tujuan'],
		'guru'   => $_POST['guru'],
		'smt'   => $_POST['smt']
		];	
	$result = insert($koneksi, 'tujuan', $data);
}

if ($pg == 'edit') {
	$id = $_POST['id'];
     $data = [
	   'lm'   => $_POST['lm'],	
	   'tujuan'   => $_POST['tujuan']
		];	
	$result = update($koneksi, 'tujuan', $data,['idt'=>$id]);
}
if ($pg == 'copy') {
	$smt = $_POST['smt'];
	$mapel = $_POST['mapel'];
	$tingkat = $_POST['level'];
	$guru = $_POST['guru'];
	$query = mysqli_query($koneksi, "SELECT * FROM cp_elemen where mapel='$mapel' and tingkat='$tingkat' and guru='$guru' and smt='$smt'");
	while ($data = mysqli_fetch_array($query)) :	  
	$result = mysqli_query($koneksi,"INSERT INTO tujuan (mapel,level,lm,tujuan,guru,smt)
				VALUES('$data[mapel]','$data[tingkat]','$data[elemen]','$data[capaian]','$data[guru]','$data[smt]')");
			
   endwhile;
}
if ($pg == 'hapus') {
    $idu = $_POST['id'];
	
    $result = delete($koneksi, 'tujuan', ['idt' => $idu]);
	if($result){
		$query = "SELECT * FROM tujuan ORDER BY idt";
       $hasil = mysqli_query($query);
 $no = 1;
 
while ($data  = mysqli_fetch_array($hasil))
{
	 $id = $data['idt'];
	 $query2 = "UPDATE tujuan SET idt = $no WHERE idt = '$id'";
   mysqli_query($koneksi,$query2);
 
   $no++;   
	}
	$query = "ALTER TABLE tujuan  AUTO_INCREMENT = $no";
mysqli_query($koneksi,$query);
	}
}