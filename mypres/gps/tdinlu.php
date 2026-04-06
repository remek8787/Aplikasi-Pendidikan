<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'hapus') {
    $idu = $_POST['id'];
    $exec = delete($koneksi, 'data_luar', ['id' => $idu]);
	if($exec){
	$query = "SELECT * FROM data_luar ORDER BY id";
       $hasil = mysqli_query($query);
 $no = 1;
 
while ($data  = mysqli_fetch_array($hasil))
{
	 $id = $data['id'];
	 $query2 = "UPDATE data_luar SET id = $no WHERE id = '$id'";
     mysqli_query($koneksi,$query2);
     $no++;   
	}
	$query = "ALTER TABLE data_luar  AUTO_INCREMENT = $no";
mysqli_query($koneksi,$query);
	}
}
if ($pg == 'tambah') {
	
     $data = [
	    'idpeg'     => $_POST['idpeg'],
        'jenis'=>'1'
			];
	$exec = insert($koneksi, 'data_luar', $data);
		               		
	
}

?>