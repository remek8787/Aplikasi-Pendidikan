<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

if ($pg == 'gaji') {
	
   $data = [
       'idpeg'     => $_POST['guru'],
	   'kode'     => $_POST['jenis'],
	   'tugas'     => $_POST['nama'],
	   'besar'     => $_POST['besar']
	  ];
			$exec = insert($koneksi, 'gaji', $data);	                   		
	 
}
if ($pg == 'edit') {
	$id = $_POST['id'];
   $data = [
        'idpeg'     => $_POST['guru'],
	   'tugas'     => $_POST['jenis'],
	   'besar'     => $_POST['besar']  
			];
    $exec = update($koneksi, 'gaji', $data, ['id' => $id]);
}

if ($pg == 'hapusgaji') {
    $id = $_POST['id'];
    $exec = delete($koneksi, 'gaji', ['id' => $id]);
	
	if($exec){
		$query = "SELECT * FROM gaji ORDER BY id";
       $hasil = mysqli_query($query);
 $no = 1;
 
while ($data  = mysqli_fetch_array($hasil))
{
	 $id = $data['id'];
	 $query2 = "UPDATE gaji SET id = $no WHERE id = '$id'";
   mysqli_query($koneksi,$query2);
 
   $no++;   
	}
	$query = "ALTER TABLE gaji  AUTO_INCREMENT = $no";
mysqli_query($koneksi,$query);
	}
}
?>