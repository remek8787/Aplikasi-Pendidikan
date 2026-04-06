<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
 
if ($pg == 'tambah') {
	
	$idel = $_POST['idel'];
	$waktu = $_POST['waktu'];
    $p5 = $_POST['p5'];
	$cpx = fetch($koneksi,'cp_elemen',['id_elemen'=>$idel]);
	$idcp = $cpx['idcp'];
	$guru = $cpx['guru'];
	$jatp = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM atp where idcp='$idcp'"));
	$ke = $jatp + 1;
	$where = [
		'idcp'   => $idcp,
		'idel'   => $idel	
			];
	
	
		$data = [
		'idcp'   => $idcp,
		'idel'   => $idel,
		'waktu'   => $waktu,
		'p5'   => $p5,
		'guru'=>$guru,
        'ke'=>$ke		
			];
	$cek = rowcount($koneksi, 'atp', $where);
    if ($cek == 0) {			
	$result = insert($koneksi, 'atp', $data);
	}else{
		$result = update($koneksi, 'atp', $data,$where);
	}
}


if ($pg == 'hapus') {
    $idu = $_POST['id'];
    $exec = delete($koneksi, 'atp', ['id_atp' => $idu]);
	if($exec){
	$query = "SELECT * FROM atp ORDER BY id_atp";
    $hasil = mysqli_query($query);
 $no = 1;
while ($data  = mysqli_fetch_array($hasil)){
	$id = $data['id_atp'];
	$query2 = "UPDATE atp SET id_atp = $no WHERE id_atp = '$id'";
    mysqli_query($koneksi,$query2);
    $no++;   
	}
$query = "ALTER TABLE atp  AUTO_INCREMENT = $no";
mysqli_query($koneksi,$query);
	}
}