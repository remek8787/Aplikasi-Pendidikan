<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'hapus') {
    $id = $_POST['id'];
	
    $result = delete($koneksi, 'jadwal_tu', ['id' => $id]);
	if($result){
		$query = "SELECT * FROM jadwal_tu ORDER BY id";
       $hasil = mysqli_query($query);
 $no = 1;
 
while ($data  = mysqli_fetch_array($hasil))
{
	 $id = $data['id'];
	 $query2 = "UPDATE jadwal_tu SET id = $no WHERE id = '$id'";
   mysqli_query($koneksi,$query2);
 
   $no++;   
	}
	$query = "ALTER TABLE jadwal_tu  AUTO_INCREMENT = $no";
mysqli_query($koneksi,$query);
	}
}
if ($pg == 'tambah') {
	
	 $where = [
      
		'hari'   => $_POST['hari'],
		'idpeg'   => $_POST['guru']		
			];
			
     $data = [
	    
		'idpeg'   => $_POST['guru'],
		'hari'   => $_POST['hari'],
		'jjk'   => $_POST['jjk'],
		'honor'   => $_POST['honor']
			];
	 $cek = rowcount($koneksi, 'jadwal_tu', $where);
    if ($cek == 0) {		
	$result = insert($koneksi, 'jadwal_tu', $data);
	}
}
