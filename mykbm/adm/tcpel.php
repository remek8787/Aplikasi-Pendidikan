<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
 
if ($pg == 'tambah') {
	
	$idcp = $_POST['idcp'];
	$elemen = $_POST['elemen'];
    $cp = $_POST['cp'];
	$cpx = fetch($koneksi,'cp',['id'=>$idcp]);
	$mapel = $cpx['mapel'];
	$tingkat = $cpx['tingkat'];
	$guru = $cpx['guru'];
	$smt = $cpx['smt'];
	
		$data = [
		'idcp'   => $idcp,
		'elemen'   => $elemen,
		'capaian'   => $cp,
		'mapel'   => $mapel,
		'tingkat'   => $tingkat,
		'guru'   => $guru,
		'smt'   => $smt
			];			
	$result = insert($koneksi, 'cp_elemen', $data);
			
}

if ($pg == 'edit') {
	$idel = $_POST['idel'];
	$elemen = $_POST['elemen'];
    $cp = $_POST['cp'];
	$data = [
		'elemen'   => $elemen,
		'capaian'   => $cp
			];	
	 $result = update($koneksi, 'cp_elemen', $data,['id_elemen'=>$idel]);
}

if ($pg == 'hapus') {
    $idu = $_POST['id'];
    $exec = delete($koneksi, 'cp_elemen', ['id_elemen' => $idu]);
	if($exec){
	$query = "SELECT * FROM cp_elemen ORDER BY id_elemen";
    $hasil = mysqli_query($query);
 $no = 1;
while ($data  = mysqli_fetch_array($hasil)){
	$id = $data['id_elemen'];
	$query2 = "UPDATE cp_elemen SET id_elemen = $no WHERE id_elemen = '$id'";
    mysqli_query($koneksi,$query2);
    $no++;   
	}
$query = "ALTER TABLE cp_elemen  AUTO_INCREMENT = $no";
mysqli_query($koneksi,$query);
	}
}