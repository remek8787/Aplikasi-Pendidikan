<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
 
if ($pg == 'tambah') {
	
	$kd = $_POST['kd'];
	$guru = $_POST['guru'];
	$mapel = $_POST['mapel'];
	$level = $_POST['level'];
    $materi = $_POST['materi'];
	$smt = $_POST['smt'];
	
		$data = [
		'kd'   => $_POST['kd'],
		'smt'   => $_POST['smt'],
		'level'   => $_POST['level'],
		'mapel'   => $_POST['mapel'],
		'guru'   => $_POST['guru'],
		'materi'   => $_POST['materi'],
		'alokasi'   => $_POST['alokasi'],
		'sisipan'   => $_POST['sisipan'],
		'des3'   => $_POST['kd3'],
		'des4'   => $_POST['kd4']
			];	
		
	$result = insert($koneksi, 'rpp', $data);
		
}

if ($pg == 'edit') {
	$id = $_POST['id'];
	$data = [
		
		'smt'   => $_POST['smt'],
		'level'   => $_POST['level'],
		'mapel'   => $_POST['mapel'],
		'guru'   => $_POST['guru'],
		'materi'   => $_POST['materi'],
		'alokasi'   => $_POST['alokasi'],
		'sisipan'   => $_POST['sisipan'],
		'des3'   => $_POST['kd3'],
		'des4'   => $_POST['kd4']
			];	
	 $result = update($koneksi, 'rpp', $data,['id'=>$id]);
}

if ($pg == 'hapus') {
    $idu = $_POST['id'];
    $exec = delete($koneksi, 'rpp', ['id' => $idu]);
	
	if($exec){
	$query = "SELECT * FROM rpp ORDER BY id";
    $hasil = mysqli_query($query);
 $no = 1;
while ($data  = mysqli_fetch_array($hasil)){
	$id = $data['id'];
	$query2 = "UPDATE rpp SET id = $no WHERE id = '$id'";
    mysqli_query($koneksi,$query2);
    $no++;   
	}
$query = "ALTER TABLE rpp  AUTO_INCREMENT = $no";
mysqli_query($koneksi,$query);
	}
}