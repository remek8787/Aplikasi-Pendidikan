<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
 
if ($pg == 'tambah') {
	
	$idel = $_POST['idel'];
	$kompen = $_POST['kompen'];
    $lingkup = $_POST['lingkup'];
	$cpx = fetch($koneksi,'cp_elemen',['id_elemen'=>$idel]);
	$idcp = $cpx['idcp'];
	$mapel = $cpx['mapel'];
	$tingkat = $cpx['tingkat'];
	$guru = $cpx['guru'];
	
		$data = [
		'idcp'   => $idcp,
		'idelemen'   => $idel,
		'kompetensi'   => $kompen,
		'lingkup'   => $lingkup,
		'tujuan'   => $kompen." ".$lingkup,
		'mapel'   => $mapel,
		'tingkat'   => $tingkat,
		'guru'   => $guru
	
			];			
	$result = insert($koneksi, 'tp', $data);
			
}

if ($pg == 'edit') {
	$idtp = $_POST['idtp'];
	$kompen = $_POST['kompen'];
    $lingkup = $_POST['lingkup'];
	$data = [
		'kompetensi'   => $kompen,
		'lingkup'   => $lingkup,
		'tujuan'   => $kompen." ".$lingkup
			];	
	 $result = update($koneksi, 'tp', $data,['id_tp'=>$idtp]);
}

if ($pg == 'hapus') {
    $idu = $_POST['id'];
    $exec = delete($koneksi, 'tp', ['id_tp' => $idu]);
	if($exec){
	$query = "SELECT * FROM tp ORDER BY id_tp";
    $hasil = mysqli_query($query);
 $no = 1;
while ($data  = mysqli_fetch_array($hasil)){
	$id = $data['id_tp'];
	$query2 = "UPDATE tp SET id_tp = $no WHERE id_tp = '$id'";
    mysqli_query($koneksi,$query2);
    $no++;   
	}
$query = "ALTER TABLE tp  AUTO_INCREMENT = $no";
mysqli_query($koneksi,$query);
	}
}