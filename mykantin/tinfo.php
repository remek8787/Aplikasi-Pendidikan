<?php
require("../config/koneksi.php");
require("../config/function.php");
require("../config/crud.php");

(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'hapus') {
    $id = $_POST['id'];
    $exec = delete($koneksi, 'informasi', ['id' => $id]);
	if($exec){
		$query = "SELECT * FROM informasi ORDER BY id";
       $hasil = mysqli_query($query);
 $no = 1;
 
while ($data  = mysqli_fetch_array($hasil))
{
	 $id = $data['id'];
	 $query2 = "UPDATE informasi SET id = $no WHERE id = '$id'";
   mysqli_query($koneksi,$query2);
 
   $no++;   
	}
	$query = "ALTER TABLE informasi  AUTO_INCREMENT = $no";
mysqli_query($koneksi,$query);
	}
}
if ($pg == 'tambah') {
	
     $data = [
	    'isi'     => $_POST['pesan'],
        'judul'     => 'INFORMASI',
        'untuk'   => $_POST['untuk'],
		'waktu'   => date('d M Y H:i:s')
      
			];
			$exec = insert($koneksi, 'informasi', $data);
			echo "OK";                   		
	  }
 if ($pg == 'reset') { 
$exec = mysqli_query($koneksi, "truncate informasi");	
 } 
	
?>