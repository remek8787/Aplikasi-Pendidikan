<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
 
if ($pg == 'tambah') {
	
	$guru = $_POST['guru'];
	$mapel = $_POST['mapel'];
	$level = $_POST['level'];
    $cp = $_POST['cp'];
	$smt = $_POST['smt'];
	$sis = fetch($koneksi,'kelas',['level'=>$level]);
		$where = [
			'smt'   => $smt,
			'tingkat'   => $level,
			'mapel'   => $mapel,
			'smt'   => $smt,
			'guru'   => $guru		
			];
			
		$data = [
		'smt'   => $smt,
		'tingkat'   => $level,
		'fase'   => $sis['fase'],
		'mapel'   => $mapel,
		'guru'   => $guru,	
		'capaian'   => $cp
		
			];	
	$cek = rowcount($koneksi, 'cp', $where);
    if ($cek == 0) {		
	$result = insert($koneksi, 'cp', $data);
	}
			
}

if ($pg == 'edit') {
	$id = $_POST['id'];
	 $cp = $_POST['cp'];
	 $data = [
		'capaian'   => $cp
			];	
	 $result = update($koneksi, 'cp', $data,['id'=>$id]);
}

if ($pg == 'hapus') {
    $idu = $_POST['id'];
    $exec = delete($koneksi, 'cp', ['id' => $idu]);
	 $exec = delete($koneksi, 'cp_elemen', ['idcp' => $idu]);
	if($exec){
	$query = "SELECT * FROM cp ORDER BY id";
    $hasil = mysqli_query($query);
 $no = 1;
while ($data  = mysqli_fetch_array($hasil)){
	$id = $data['id'];
	$query2 = "UPDATE cp SET id = $no WHERE id = '$id'";
    mysqli_query($koneksi,$query2);
    $no++;   
	}
$query = "ALTER TABLE cp  AUTO_INCREMENT = $no";
mysqli_query($koneksi,$query);
	}
}