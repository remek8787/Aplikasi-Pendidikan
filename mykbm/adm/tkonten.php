<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
 
if ($pg == 'tambah') {
	$where = [
		'idcp'   => $_POST['idcp'],
		'idel'   => $_POST['idel'],
		'idtp'   => $_POST['idtp'],
			];
			
		$data = [
		'idcp'   => $_POST['idcp'],
		'idel'   => $_POST['idel'],
		'idtp'   => $_POST['idtp'],
		'sub'   => $_POST['sub'],
		'ringkasan'   => $_POST['ringkasan'],
		'gambaran'   => $_POST['gambaran'],
		'media'   => $_POST['media'],
		'sumber'   => $_POST['sumber'],
		'mapel'   => $_POST['mapel'],
		'tingkat'   => $_POST['tingkat'],
		'guru'   => $_POST['guru']
	
			];	
		$cek = rowcount($koneksi, 'konten', $where);
    if ($cek == 0) {	
	$result = insert($koneksi, 'konten', $data);
	}else{
	$result = update($koneksi, 'konten', $data,$where);
	}		
}

if ($pg == 'hapus') {
    $idu = $_POST['id'];
    $exec = delete($koneksi, 'konten', ['id_konten' => $idu]);
	if($exec){
	$query = "SELECT * FROM konten ORDER BY id_konten";
    $hasil = mysqli_query($query);
 $no = 1;
while ($data  = mysqli_fetch_array($hasil)){
	$id = $data['id_konten'];
	$query2 = "UPDATE konten SET id_konten = $no WHERE id_konten = '$id'";
    mysqli_query($koneksi,$query2);
    $no++;   
	}
$query = "ALTER TABLE konten  AUTO_INCREMENT = $no";
mysqli_query($koneksi,$query);
	}
}