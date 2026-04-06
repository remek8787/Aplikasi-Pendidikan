<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'hapus') {
    $idu = $_POST['id'];
    $exec = delete($koneksi, 'pkl_kompetensi', ['id' => $idu]);
	if($exec){
	$query = "SELECT * FROM pkl_kompetensi ORDER BY id";
       $hasil = mysqli_query($query);
 $no = 1;
 
while ($data  = mysqli_fetch_array($hasil))
{
	 $id = $data['id'];
	 $query2 = "UPDATE pkl_kompetensi SET id = $no WHERE id = '$id'";
     mysqli_query($koneksi,$query2);
     $no++;   
	}
	$query = "ALTER TABLE pkl_kompetensi  AUTO_INCREMENT = $no";
mysqli_query($koneksi,$query);
	}
}
if ($pg == 'tambah') {
	$jurusan = $_POST['jurusan'];
    $deskrip = $_POST['deskrip'];
 
mysqli_query($koneksi,"INSERT INTO pkl_kompetensi(jurusan,deskrip) VALUES('$jurusan','$deskrip')");
}

if ($pg == 'edit') {
	$id = $_POST['id'];
    $data = [
        'deskrip'   => $_POST['deskrip']
	
			];
	$simpan = update($koneksi, 'pkl_kompetensi', $data,['id'=>$id]);
}

?>