<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
	 $idu = $_POST['id'];
    $exec = delete($koneksi, 'mapel', ['id' => $idu]);
	if($exec){
	$query = "SELECT * FROM mapel ORDER BY id";
    $hasil = mysqli_query($query);
 $no = 1;
while ($data  = mysqli_fetch_array($hasil)){
	$id = $data['id'];
	$query2 = "UPDATE mapel SET id = $no WHERE id = '$id'";
    mysqli_query($koneksi,$query2);
    $no++;   
	}
$query = "ALTER TABLE mapel  AUTO_INCREMENT = $no";
mysqli_query($koneksi,$query);
	}
?>