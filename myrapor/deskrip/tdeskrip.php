<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'hapus') {
    $id = $_POST['id'];
	
    $result = delete($koneksi, 'deskripsi', ['id' => $id]);
	if($result){
		$query = "SELECT * FROM deskripsi ORDER BY id";
       $hasil = mysqli_query($query);
 $no = 1;
 
while ($data  = mysqli_fetch_array($hasil))
{
	 $id = $data['id'];
	 $query2 = "UPDATE deskripsi SET id = $no WHERE id = '$id'";
   mysqli_query($koneksi,$query2);
 
   $no++;   
	}
	$query = "ALTER TABLE deskripsi  AUTO_INCREMENT = $no";
mysqli_query($koneksi,$query);
	}
}
if ($pg == 'tambah') {
	
	 $where = [
        'level'   => $_POST['level'],
		'mapel'   => $_POST['mapel'],
		'ki'   => $_POST['ki'],
		'smt'   => $semester
			];
	$cek = rowcount($koneksi, 'deskripsi', $where);
   	$nom = $cek + 1;
	if($_POST['ki']=='KI-3'){
	$kd = "3.".$nom;
	}else{
	$kd = "4.".$nom;
	}
     $data = [
	   'level'   => $_POST['level'],
		'mapel'   => $_POST['mapel'],
		'deskripsi'   => $_POST['deskrip'],
		'ki'   => $_POST['ki'],
		'kd'   => $kd,
		'smt'   => $semester,
		'guru'   => $_POST['guru']
		];	
	$result = insert($koneksi, 'deskripsi', $data);
}
if ($pg == 'edit') {
	$id = $_POST['id'];
     $data = [
	   'deskripsi'   => $_POST['deskrip']	
		];	
	$result = update($koneksi, 'deskripsi', $data,['id'=>$id]);
}
