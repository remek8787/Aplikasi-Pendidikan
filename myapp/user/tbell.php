<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'hapus') {
    $idu = $_POST['id'];
    $exec = delete($koneksi, 'bell', ['id' => $idu]);
	if($exec){
	$query = "SELECT * FROM bell ORDER BY id";
       $hasil = mysqli_query($query);
 $no = 1;
 
while ($data  = mysqli_fetch_array($hasil))
{
	 $id = $data['id'];
	 $query2 = "UPDATE bell SET id = $no WHERE id = '$id'";
     mysqli_query($koneksi,$query2);
     $no++;   
	}
	$query = "ALTER TABLE bell  AUTO_INCREMENT = $no";
mysqli_query($koneksi,$query);
	}
}
if ($pg == 'tambah') {
	
     $data = [
	    'hari'     => $_POST['hari'],
        'jam'     => $_POST['jam'],
        'nada'   => $_POST['nada'],
		'ket'   => $_POST['ket']
		   
			];
			$exec = insert($koneksi, 'bell', $data);
		
}
if ($pg == 'edit') {
	$id = $_POST['id'];  
        $data = [
       'hari'     => $_POST['hari'],
        'jam'     => $_POST['jam'],
        'nada'   => $_POST['nada'],
		'ket'   => $_POST['ket']
        ];
    $exec = update($koneksi, 'bell', $data, ['id' => $id]);
  
}

?>