<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'hapus') {
    $idu = $_POST['id'];
    $exec = delete($koneksi, 'pkl_mnilai', ['id' => $idu]);
	if($exec){
	$query = "SELECT * FROM pkl_mnilai ORDER BY id";
       $hasil = mysqli_query($query);
 $no = 1;
 
while ($data  = mysqli_fetch_array($hasil))
{
	 $id = $data['id'];
	 $query2 = "UPDATE pkl_mnilai SET id = $no WHERE id = '$id'";
     mysqli_query($koneksi,$query2);
     $no++;   
	}
	$query = "ALTER TABLE pkl_mnilai  AUTO_INCREMENT = $no";
mysqli_query($koneksi,$query);
	}
}
if ($pg == 'tambah') {
	$kode = $_POST['kode'];
    $aspek = $_POST['aspek'];
	$jurusan = 'semua';	
	
mysqli_query($koneksi,"INSERT INTO pkl_mnilai(kode,jurusan,aspek) VALUES('$kode','$jurusan','$aspek')");

}



?>